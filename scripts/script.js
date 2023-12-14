function downloadPdf() {
    // Provide the path to your PDF file
    const pdfFilePath = 'files/CV.pdf';
    
    // Create an anchor element
    const anchor = document.createElement('a');
    
    // Set the href attribute to the PDF file path
    anchor.href = pdfFilePath;
    
    // Set the download attribute to specify the suggested file name
    anchor.download = 'CV - Daniel Nikolaj Hartwich.pdf';
    
    // Append the anchor to the document body
    document.body.appendChild(anchor);
    
    // Trigger a click event on the anchor to initiate the download
    anchor.click();
    
    // Remove the anchor from the document body
    document.body.removeChild(anchor);
}