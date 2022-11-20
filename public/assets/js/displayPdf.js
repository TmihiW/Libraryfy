class viewPdf{    
    url='assets/pdfFile/Information_Security.pdf';
    //change the url of pdf file
    static pdfDoc=null;
    static pageNum=1;
    static numPages=0;
    constructor(){
        this.getData(viewPdf.pageNum);
    }

    getData(pageNum){
        pdfjsLib.getDocument(this.url)
        .promise.then(res=>{
            console.log(res);
            viewPdf.pdfDoc = res;
            viewPdf.numPages = viewPdf.pdfDoc.numPages;    
            console.log(viewPdf.numPages);
            viewPdf.renderPage(pageNum);
        });
    }
    static renderPage(num){
        let canvas = document.querySelector('#pdfArea');
        let ctx = canvas.getContext('2d');
        let scale=1.5;

        viewPdf.pdfDoc.getPage(num).then(pageResponse=>{
            const viewport = pageResponse.getViewport({scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport
            }
            pageResponse.render(renderContext);
        })
    }
    static nextPage(){ 
        if(viewPdf.pageNum >= viewPdf.numPages){
            return;
        }
        viewPdf.pageNum++;
        //viewPdf.renderPage(viewPdf.pageNum);
        viewPdf.reRenderCanvas();
    }
    static prevPage(){
        if(viewPdf.pageNum <= 1){
            return;
        }
        viewPdf.pageNum--;
        //viewPdf.renderPage(viewPdf.pageNum);
        viewPdf.reRenderCanvas();
    }

    static reRenderCanvas(){
        setTimeout(()=>{
            viewPdf.renderPage(viewPdf.pageNum);
        },250);  
    }      

}

/* later...
//on button click
function newUrl(){
    var newPdf =document.getElementById('pdfName').value;
    //changing url of pdf file
    viewPdf.url='assets/pdfFile/'+newPdf;
    viewPdf.pageNum = 1;
    viewPdf.reRenderCanvas();
}
*/