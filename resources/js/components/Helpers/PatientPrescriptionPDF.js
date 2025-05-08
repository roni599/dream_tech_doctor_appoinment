import html2pdf from 'html2pdf.js';

class PatienPrescriptionPDF {
    constructor(hospitalName, hospitalLogo, doctorName, departmentCategory, visit_date) {
        this.hospitalName = hospitalName;
        this.hospitalLogo = hospitalLogo;
        this.doctorName = doctorName;
        this.departmentCategory = departmentCategory;
        this.visit_date = visit_date;
        this.element = document.getElementById('appointment-table');
    }

    generatePDF() {
        const clonedTable = this.element.cloneNode(true);
        clonedTable.querySelectorAll('th').forEach(header => {
            if (header.textContent.trim() === 'Discount' || header.textContent.includes('Narration')) {
                header.style.backgroundColor = '#1d93d2';
                header.style.color = 'white';
            }
        });

        clonedTable.style.border = '1px solid #1d93d2';

        clonedTable.querySelectorAll('th').forEach(header => {
            header.style.border = '1px solid white';
        });

        clonedTable.querySelectorAll('td').forEach(cell => {
            cell.style.border = '1px solid rgb(201, 200, 200)';
        });

        const actionHeaders = clonedTable.querySelectorAll('th#action');
        const actionCells = clonedTable.querySelectorAll('td#eye');

        actionHeaders.forEach(header => header.remove());
        actionCells.forEach(cell => cell.remove());

        const options = {
            margin: [2.5, 0.5, 0.5, 0.5],
            filename: 'patientPrescription.pdf',
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
                orientation: 'landscape'
            }
        };

        html2pdf().from(clonedTable).set(options).toPdf().get('pdf').then((pdf) => {
            const pageWidth = pdf.internal.pageSize.width;
            const logo = `/hospital/backend/img/users/logo/${this.hospitalLogo}`;
            const logoX = 3.5;
            const logoY = 0.5;
            const logoWidth = 1;
            const logoHeight = 0.6;
            pdf.addImage(logo, 'JPEG', logoX, logoY, logoWidth, logoHeight);

            pdf.setFontSize(18);
            const text = this.hospitalName;
            const textWidth = pdf.getTextWidth(text);
            const xPos = (pageWidth - textWidth) / 2;
            pdf.text(text, xPos, 0.9);

            pdf.setFontSize(14);
            pdf.text(`Patient Appoinment Report`, .5, 1.4);
            pdf.text(`Doctor Name: ${this.doctorName}`, .5, 1.7);
            pdf.text(`Department Name: ${this.departmentCategory}`, .5, 2);
            pdf.text(`Date: ${this.visit_date}`, .5, 2.3);

            pdf.save('patientPrescription.pdf');
        });
    }
}

export default PatienPrescriptionPDF;
