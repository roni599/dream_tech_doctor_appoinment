import html2pdf from 'html2pdf.js';

class PatienPrescriptionPDF {
    constructor(hospitalName,address,mobile_number1,mobile_number_2, hospitalLogo, doctorName, departmentCategory, visit_date,pdfFileName) {
        this.hospitalName = hospitalName;
        this.hospitalLogo = hospitalLogo;
        this.doctorName = doctorName;
        this.departmentCategory = departmentCategory;
        this.visit_date = visit_date;
        this.address = address;
        this.mobile_number1 = mobile_number1;
        this.mobile_number_2 = mobile_number_2;
        this.pdfFileName = pdfFileName;
        this.element = document.getElementById('appointment-table');
        console.log(this.doctorName)
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
            margin: [2.6, 0.5, 0.5, 0.5],
            filename: `${this.pdfFileName}.pdf`,  
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
            
            pdf.text(text, xPos, .7);

            pdf.setFontSize(12);
            const address = this.address;
            const mobileNumber1 = this.mobile_number1;
            const mobileNumber2 = this.mobile_number_2;

            pdf.text(address, xPos, .9); 
            pdf.text(`Mobile: ${mobileNumber1}, ${mobileNumber2}`, xPos, 1.1); 

            pdf.setFontSize(14);
            const reportTitle = "Patient Appointment Report";
            const reportTitleWidth = pdf.getTextWidth(reportTitle);
            const reportTitleXPos = (pageWidth - reportTitleWidth) / 2;
            pdf.text(reportTitle, reportTitleXPos, 1.6);

            pdf.text(`Doctor Name: ${this.doctorName}`, .5, 1.9);
            pdf.text(`Department Name: ${this.departmentCategory}`, .5, 2.2);
            pdf.text(`Date: ${this.visit_date}`, .5, 2.5);

            const filename = `${this.pdfFileName}.pdf`;
            pdf.save(filename);
        });

    }

}

export default PatienPrescriptionPDF;
