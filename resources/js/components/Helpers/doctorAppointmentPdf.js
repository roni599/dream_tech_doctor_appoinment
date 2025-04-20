import html2pdf from 'html2pdf.js';
export default class doctorAppointmentPdf {
    constructor(hospitalName, hospitalLogo) {
        this.hospitalName = hospitalName;
        this.hospitalLogo = hospitalLogo;
        this.buttonGroup = document.querySelector('.button_group');
        this.element = document.getElementById('appointment-table');
    }

    hideButtons() {
        this.buttonGroup.classList.add('hide-buttons');
    }

    showButtons() {
        this.buttonGroup.classList.remove('hide-buttons');
    }

    generatePDF() {
        this.hideButtons();

        const options = {
            margin: .9,
            filename: 'appointments.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 3,
                logging: true,
                letterRendering: true,
                useCORS: true
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'landscape',
                putOnlyUsedFonts: true,
            }
        };

        html2pdf().from(this.element).set(options).toPdf().get('pdf').then((pdf) => {
            const pageWidth = pdf.internal.pageSize.width;
            const logo = `/hospital/backend/img/users/logo/${this.hospitalLogo}`;
            const logoX = 3.5;
            const logoY = 0.1;
            const logoWidth = 1;
            const logoHeight = 0.6;
            pdf.addImage(logo, 'JPEG', logoX, logoY, logoWidth, logoHeight);
            pdf.setFontSize(18);
            const text = this.hospitalName;
            const textWidth = pdf.getTextWidth(text);
            const xPos = (pageWidth - textWidth) / 2;
            pdf.text(text, xPos, .5);
            pdf.setFontSize(12);
            pdf.save('appointments.pdf');

            this.showButtons();
        });
    }
}
