<?php
declare(strict_types=1);

namespace App\Presenters;

use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Nette\Application\UI\Presenter;

final class HomePresenter extends Presenter
{
    public function renderDefault(): void
    {
    }

    public function actionGenerate(): void
    {
        $post = $this->getHttpRequest()->getPost();

        $mpdfDir = dirname(__DIR__, 2) . '/temp/mpdf';
        if (!is_dir($mpdfDir)) {
            mkdir($mpdfDir, 0777, true);
        }

        $template = $this->createTemplate();
        $template->setFile(__DIR__ . '/templates/Home/pdf.latte');
        $template->protocolNumber = (string) ($post['protocol_number'] ?? 'SP-0001');
        $template->protocolDate = (string) ($post['protocol_date'] ?? date('Y-m-d'));
        $template->representativeName = (string) ($post['representative_name'] ?? '');
        $template->customerName = (string) ($post['customer_name'] ?? '');
        $template->workDescription = (string) ($post['work_description'] ?? '');
        $template->representativeSignature = (string) ($post['representative_signature'] ?? '');
        $template->customerSignature = (string) ($post['customer_signature'] ?? '');
        $template->signedAt = date('Y-m-d H:i:s');

        $html = (string) $template;

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'tempDir' => $mpdfDir,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_header' => 5,
            'margin_footer' => 8,
        ]);

        $stylePath = dirname(__DIR__, 2) . '/css/pdf.css';
        if (is_file($stylePath)) {
            $mpdf->WriteHTML(file_get_contents($stylePath), HTMLParserMode::HEADER_CSS);
        }

        $mpdf->SetTitle('Demo: PDF Generation - ' . $template->protocolNumber);
        $mpdf->SetAuthor('Paperless Document Engine');
        $mpdf->WriteHTML($html, HTMLParserMode::HTML_BODY);

        $safeFilename = 'demo-protocol-' . preg_replace('/[^a-zA-Z0-9_\-]/', '_', $template->protocolNumber) . '.pdf';
        $mpdf->Output($safeFilename, Destination::INLINE);

        $this->terminate();
    }
}
