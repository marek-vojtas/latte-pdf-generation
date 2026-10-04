# Demo: PDF Generation with Digital Signatures

A simple web application built with **PHP 8.3** and **Nette Framework 3** that captures digital signatures on an HTML5 Canvas and exports them into a clean PDF document using **mPDF** and **Latte**.

---

## Features

- **Two Signature Pads**: Separate canvas fields for the Sales Representative and the Customer.
- **Touch and Mouse Support**: Works on desktop computers, tablets, and smartphones.
- **HTML5 Canvas to Base64**: Signatures are converted into Base64 PNG images and sent with the form.
- **Latte Templating**: Clean separation of HTML structure and PHP logic.
- **mPDF Generator**: Generates a professional PDF service protocol with crisp signatures.
- **Docker Ready**: Easy local setup with Docker and Docker Compose.

---

## Tech Stack

- **PHP 8.3**
- **Nette Framework 3** (Application, Routing, Bootstrap)
- **Latte 3** (Template Engine)
- **mPDF 8.2** (PDF Generator)
- **HTML5 Canvas and Vanilla JavaScript**
- **Docker and Apache**

---

## How It Works

1. The user fills out the protocol details (number, date, names, work description).
2. The representative and customer sign on their respective canvas pads.
3. JavaScript converts each canvas drawing into a Base64 string and saves it into a hidden input field.
4. When submitted, the Nette presenter receives the data.
5. Latte renders the PDF template with the form data and embedded signatures.
6. mPDF converts the generated HTML into a PDF file and opens it in the browser.

---

## Getting Started

### Requirements
- Docker and Docker Compose

### Installation and Run

1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/php-canvas-signature-to-pdf.git
   cd php-canvas-signature-to-pdf
   ```

2. Start the Docker container:
   ```bash
   docker compose up -d --build
   ```

3. Open your browser and visit:
   ```text
   http://localhost:8085
   ```

---

## Project Structure

```text
├── app/
│   ├── Bootstrap.php                # Application setup and cache config
│   ├── config/
│   │   └── common.neon              # Nette DI and routing settings
│   ├── Presenters/
│   │   ├── HomePresenter.php        # Form handling and PDF generation logic
│   │   └── templates/
│   │       ├── @layout.latte        # Base HTML layout
│   │       └── Home/
│   │           ├── default.latte    # Web form with HTML5 canvas signature pads
│   │           └── pdf.latte        # PDF document template
│   └── Router/
│       └── RouterFactory.php        # URL routing
├── css/
│   ├── style.css                    # Web form styles
│   └── pdf.css                      # PDF print styles
├── Dockerfile                       # PHP 8.3 + GD + Composer image
├── docker-compose.yml               # Container port and volume configuration
├── composer.json                    # PHP dependencies
├── sample-protocol.pdf              # Example generated PDF document
└── index.php                        # Web entry point
```

---

## Sample PDF

You can view the example generated document directly in this repository:
- [sample-protocol.pdf](sample-protocol.pdf)
