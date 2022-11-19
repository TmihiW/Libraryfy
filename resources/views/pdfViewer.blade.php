<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #pdfArea {
            border: solid 1px red;
        }
    </style>
</head>
<body>
            <button onclick="viewPdf.prevPage()">Prev</button>
            <button onclick="viewPdf.nextPage()">Next</button>
            <div >
                <canvas id="pdfArea" class="pdfArea"></canvas>                    
            </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.0.279/pdf.min.js"></script>
        <script src="https://cdnjs.com/libraries/pdf.js"></script>         
        <script src="{{ asset('assets/js/viewPdf.js') }}"></script>                                
        <script> let currentView = new viewPdf();</script>
    </body>
</html>