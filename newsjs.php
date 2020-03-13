<html>
    
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
 
<body>
    <div>
        
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function(){
        makingNewsWithJquery('sadasd');
        makingNewsWithJquery('scxvcxv');
    });
    makingComment(id, autor, tresc, score, plusy, minusy);
function makingNews(divId){
    
    var newDiv = document.createElement("div");
    newDiv.setAttribute("id", divId);
    var h = document.createElement("H1");
    h.innerHTML = "Naglowek";
    newDiv.appendChild(h);
    
    var p = document.createElement("P");
    p.innerHTML = "Tutaj jest tresc";
    newDiv.appendChild(p);
    document.body.appendChild(newDiv);
  }
function makingNewsWithJquery(divId){
    
    var newDiv = $("<div>");
    newDiv.attr("id", divId);
    var h = $("<H1>");
    h.text( "Naglowek");
    newDiv.html(h);
    
    var p =$("<P>");
    p.text("Tutaj jest tresc");
    h.after(p);
    $("body").html(newDiv);
  }
/*function creatingNews(){
    var h = document.createElement("H1");
    h.innerHTML("Naglowek");
    document.contener.appendChild("h");
    var p = document.createElement("P");
    p.innerHTML("Tutaj jest tresc");
    document.contener.appendChild("p");
  
  
  <body onload="creatingNews()">
    <div id = "js-div">
        
    </div>
</body>
}*/
    
//var para = document.createElement("P");               
//para.innerText = "Tu jest tresc";               
//document.body.appendChild(para);
//makingNews(23);
//makingNews(25);
</script>