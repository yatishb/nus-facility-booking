<?php include("inc/header.php"); ?>
<script>
document.getElementById("mastlink-home").className = "active";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<div class="home-holder">
	<form class="form-horizontal" action="login.php" method="post">
		<p class="heading-search nusorange">Search for a facility</p>
        <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Region</label>
	        <div class="col-sm-6">
	        <select class="form-control">
			  <option>Choose Region</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
	        </div>
        </div>
        <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Facility</label>
	        <div class="col-sm-6">
	        <select class="form-control">
			  <option>Choose Facility</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
	        </div>
        </div>
         <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Date/Time</label>
	        <div class="col-sm-6">
			    <input type="text" class="form-control dateform-left" placeholder="dd/mm/yyyy HH:MM"></input>
			    <input type="text" class="form-control dateform-right" placeholder="dd/mm/yyyy HH:MM"></input>
			  </div>
	        </div>
        <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-6">
		        <button class="btn btn-warning" type="submit">Search</button>
	        </div>
        </div>
    </form>
</div>

<br><br>

<div class="map-holder">
<h1 id="imagehead">or click on a region<br>to search</h1>
<img id="shape1" src="/cs2102/img/map.png" alt="" usemap="#shape1">
<script src="/cs2102/js/imagemapster.js"></script>
<script>
$(document).ready(function ()
{
	$('#shape1').mapster({
    mapKey: 'data-key',
	fill : true,
	fillColor: 'fca905',
	fillOpacity : 0.8,
	clickNavigate: true,
	showToolTip: true,
	areas:  [{
               key: "utown", 
               toolTip: "University Town"
            }, {
               key: "engin", 
               toolTip: "Engineering"
            }, {
               key: "sde", 
               toolTip: "School of Design"
            }, {
               key: "clb", 
               toolTip: "Central Library"
            }, {
               key: "pgp", 
               toolTip: "Prince George's Park"
            }, {
               key: "biz", 
               toolTip: "Business"
            }, {
               key: "nec", 
               toolTip: "PGP NEC Houses"
            }, {
               key: "src", 
               toolTip: "Sports and Recreation Center"
            }, {
               key: "yih", 
               toolTip: "Yousof Ishak House"
            }, {
               key: "nuh", 
               toolTip: "National University Hospital"
            }, {
               key: "fass", 
               toolTip: "Faculty of Arts and Social Sciences"
            }, {
               key: "ucc", 
               toolTip: "University Cultural Centre"
            }, {
               key: "med", 
               toolTip: "Medicine"
            }, {
               key: "sci", 
               toolTip: "Science"
            }, {
               key: "comp", 
               toolTip: "Computing"
            }]
});
});
</script>

<map name="shape1">
    <area href="inc/search.php" data-key="utown" shape="poly" coords="67, 304, 45, 275, 30, 223, 21, 171, 15, 111, 9, 62, 7, 24, 28, 35, 48, 37, 69, 39, 92, 35, 103, 32, 110, 44, 130, 51, 131, 67, 138, 70, 141, 106, 151, 125, 156, 135, 187, 143, 215, 147, 224, 148, 229, 170, 235, 176, 218, 195, 214, 217, 234, 242, 250, 255, 274, 269, 262, 292, 250, 315, 233, 329, 203, 332, 170, 326, 135, 323, 98, 317"/>
    <area href="inc/search.php" data-key="nec" shape="poly" coords="441, 709, 444, 675, 489, 659, 521, 665, 538, 685, 582, 689, 610, 703, 635, 716, 611, 742, 572, 729, 548, 737, 506, 731, 460, 726" />
    <area href="search.php" data-key="yih" shape="poly" coords="261, 550, 282, 513, 324, 522, 333, 543, 301, 562, 268, 573" />
    <area href="inc/search.php" data-key="pgp" shape="poly" coords="636, 733, 668, 761, 698, 765, 727, 740, 757, 716, 776, 713, 771, 736, 755, 768, 757, 797, 740, 812, 695, 833, 678, 836, 656, 818, 626, 796, 611, 781, 605, 751" />
    <area href="inc/search.php" data-key="med" shape="poly" coords="581, 490, 603, 478, 638, 479, 649, 494, 659, 528, 665, 556, 671, 569, 658, 595, 651, 612, 616, 615, 606, 615, 617, 595, 617, 569, 590, 551, 572, 531, 564, 521, 578, 507" />
    <area href="inc/search.php" data-key="sci" shape="poly" coords="466, 536, 478, 563, 467, 581, 459, 620, 463, 635, 501, 635, 526, 622, 553, 617, 580, 620, 596, 618, 609, 597, 609, 572, 584, 557, 563, 534, 550, 523, 571, 503, 572, 492, 547, 501, 538, 516, 518, 525, 492, 535" />
    <area href="inc/search.php" data-key="nuh" shape="poly" coords="655, 489, 671, 551, 680, 571, 667, 590, 658, 615, 689, 651, 701, 664, 735, 656, 768, 655, 770, 670, 789, 675, 807, 655, 784, 602, 777, 567, 752, 520, 708, 486" />
    <area href="inc/search.php" data-key="biz" shape="poly" coords="349, 719, 361, 707, 393, 727, 418, 732, 440, 748, 441, 763, 452, 772, 487, 779, 495, 806, 454, 799, 417, 783, 401, 798, 397, 818, 371, 825, 346, 812, 357, 791, 374, 782, 380, 765, 355, 744" />
    <area href="inc/search.php" data-key="comp" shape="poly" coords="293, 701, 299, 682, 310, 673, 332, 691, 352, 705, 341, 721, 347, 743, 374, 770, 365, 782, 338, 766, 318, 742, 291, 728" />
    <area href="inc/search.php" data-key="fass" shape="poly" coords="166, 739, 177, 765, 195, 788, 225, 801, 245, 802, 260, 789, 272, 758, 275, 733, 285, 705, 293, 684, 271, 676, 238, 680, 222, 672, 201, 687, 174, 695, 167, 698, 173, 722" />
    <area href="inc/search.php" data-key="clb" shape="poly" coords="232, 606, 266, 608, 290, 604, 290, 636, 266, 645, 264, 671, 244, 674, 228, 653" />
    <area href="inc/search.php" data-key="src" shape="poly" coords="290, 398, 290, 438, 292, 478, 291, 504, 319, 508, 340, 497, 360, 495, 382, 500, 401, 514, 422, 522, 450, 525, 481, 527, 502, 523, 527, 513, 545, 493, 546, 474, 539, 436" />
    <area href="inc/search.php" data-key="ucc" shape="poly" coords="69, 459, 107, 454, 140, 458, 167, 447, 174, 431, 177, 394, 173, 371, 136, 367, 111, 393, 81, 405, 72, 435" />
    <area href="inc/search.php" data-key="sde" shape="poly" coords="75, 592, 86, 594, 112, 620, 126, 635, 153, 634, 177, 635, 203, 650, 206, 658, 192, 670, 174, 678, 164, 684, 145, 692, 125, 703, 110, 723, 98, 694, 93, 664, 80, 623" />
    <area href="inc/search.php" data-key="engin" shape="poly" coords="67, 500, 93, 499, 134, 497, 153, 498, 175, 500, 192, 512, 216, 522, 241, 542, 245, 558, 232, 570, 228, 589, 224, 606, 223, 624, 213, 650, 192, 635, 172, 628, 139, 627, 126, 628, 106, 606, 84, 583, 69, 581, 57, 547, 55, 503" />
   </map>
</div>

<?php include("inc/footer.php"); ?>
