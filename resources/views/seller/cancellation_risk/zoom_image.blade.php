<style>
body {font-family: Arial, Helvetica, sans-serif;}

.image-zoom {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close1 {
       position: absolute;
    right: 23%;
    color: #f1f1f1;
    font-size: 40px;
    margin-top: -23px;
    font-weight: bold;
    transition: 0.3s;
    z-index: 1;
}

.close1:hover,
.close1:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<!-- The Modal -->
<div id="myModal1" class="modal">
  <span class="close1">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<script>
// Get the modal
function zoom_image(value)
{
	var modal = document.getElementById('myModal1');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById(value);
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	
		modal.style.display = "block";
		modalImg.src = img.src;
		captionText.innerHTML = img.alt;
	
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];
var modal = document.getElementById('myModal1');
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>