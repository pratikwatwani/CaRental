
function message(button)
{
	var num=button.id+"reg";
	var vnum=document.getElementById(num).textContent;
	visitpage(vnum);
}
function visitpage(url)
{
	window.location='confirm.php?vehicle='+url;
}

function offer(button,i)
{
	var num=button.id+"reg";
	var vnum=document.getElementById(num).textContent;
	var offer_price='offer'+i;
	var fee=document.getElementById(offer_price).innerText;
	checkout(vnum,fee);
}
function checkout(url,fee)
{
	window.location='confirm.php?vehicle='+url+'&offer='+fee;
}