<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use Spipu\Html2Pdf\Html2Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ProductPageController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'supplier'])->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create_form');
    }

    public function edit(Product $product)
    {
        return view('products.update_form', ['id' => $product->id_product]);
    }

    public function print()
    {
        $products = Product::with(['brand.supplier'])->get();

        $logoPath = public_path('images/logo.png');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }

        $html = '
        <style>
            body {
                font-family: Helvetica, Arial, sans-serif;
                background-color: #ffffff;
                color: #333;
            }
            h1 {
                text-align: center;
                color: #1a73e8;
                margin-bottom: 5px;
            }
            .logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .logo img {
                width: 100px;
            }
            table {
                width: 90%;
                margin: 0px 0px 0px 10%;
                border-collapse: collapse;
                margin-top: 20px;
                font-size: 12px;
            }
            th {
                background-color: #1a73e8;
                color: white;
                padding: 10px;
                text-align: center;
            }
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
            tr:nth-child(even) {
                background-color: #f2f6fc;
            }
            tr:hover {
                background-color: #e8f0fe;
            }
            .footer {
                text-align: center; /* Centrar texto del footer */
                font-size: 10px;
                margin-top: 30px;
                color: #555;
            }
        </style>

        <h1>Reporte de Productos</h1>
        <div class="logo">';
            if ($logoBase64 != '') {
                $html .= '<img src="' . $logoBase64 . '" alt="Logo">';
            } else {
                $html .= '<p><i>(Logo no disponible)</i></p>';
            }
        $html .= '</div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Proveedor</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($products as $p) {
            $html .= '
                <tr>
                    <td>' . $p->id_product . '</td>
                    <td>' . htmlspecialchars($p->product) . '</td>
                    <td>' . htmlspecialchars($p->brand->brand ?? 'Sin marca') . '</td>
                    <td>' . htmlspecialchars($p->brand->supplier->name ?? 'Sin proveedor') . '</td>
                    <td>$' . number_format($p->sale_price, 2) . '</td>
                    <td>$' . number_format($p->purchase_price, 2) . '</td>
                </tr>';
        }

        $html .= '
            </tbody>
        </table>

        <div class="footer">
            <p>Generado automáticamente el ' . date('d/m/Y H:i') . '</p>
        </div>';

        $pdf = new Html2Pdf('P', 'A4', 'es');
        $pdf->writeHTML($html);
        $pdf->output('reporte_productos.pdf');
    }


    public function stats()
    {
        $brands = Brand::withCount('products')->get();

        $chartData = [];
        foreach ($brands as $brand) {
            $chartData[] = [$brand->brand, $brand->products_count];
        }

        return view('products.stats', compact('chartData'));
    }

    public function exportExcel()
    {
        $products = Product::with(['brand.supplier'])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Productos');

        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Reporte de Productos');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Generado automáticamente el ' . date('d/m/Y H:i'));
        $sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(11);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $headers = ['ID', 'Producto', 'Marca', 'Proveedor', 'Precio Venta', 'Precio Compra'];
        $sheet->fromArray($headers, null, 'A4');
        $sheet->getStyle('A4:F4')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A4:F4')->getFill()->setFillType('solid')->getStartColor()->setARGB('FF1A73E8');
        $sheet->getStyle('A4:F4')->getAlignment()->setHorizontal('center');

        $row = 5;
        foreach ($products as $p) {
            $sheet->setCellValue("A{$row}", $p->id_product);
            $sheet->setCellValue("B{$row}", $p->product);
            $sheet->setCellValue("C{$row}", $p->brand->brand ?? 'Sin marca');
            $sheet->setCellValue("D{$row}", $p->brand->supplier->name ?? 'Sin proveedor');
            $sheet->setCellValue("E{$row}", $p->sale_price);
            $sheet->setCellValue("F{$row}", $p->purchase_price);
            $row++;
        }

        $chartSheet = new Worksheet($spreadsheet, 'Gráfica');
        $spreadsheet->addSheet($chartSheet, 1);

        $brandCounts = Brand::withCount('products')->get();
        $chartSheet->fromArray(['Marca', 'Cantidad de Productos'], null, 'A1');

        $chartRow = 2;
        foreach ($brandCounts as $b) {
            $chartSheet->setCellValue("A{$chartRow}", $b->brand);
            $chartSheet->setCellValue("B{$chartRow}", $b->products_count);
            $chartRow++;
        }

        $dataSeriesLabels = [new DataSeriesValues('String', 'Gráfica!$B$1', null, 1)];
        $xAxisTickValues = [new DataSeriesValues('String', 'Gráfica!$A$2:$A$' . ($chartRow - 1), null, ($chartRow - 2))];
        $dataSeriesValues = [new DataSeriesValues('Number', 'Gráfica!$B$2:$B$' . ($chartRow - 1), null, ($chartRow - 2))];

        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $plotArea = new PlotArea(null, [$series]);
        $chartTitle = new Title('Distribución de Productos por Marca');
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $chart = new Chart('chart1', $chartTitle, $legend, $plotArea);

        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('L20');

        $chartSheet->addChart($chart);

        $fileName = 'reporte_productos_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $writer->save('php://output');
        exit;
    }
}
