function menu_over(id,lvl)
{
	if(id==null)	return
	if(lvl==null)	return
	t_cell = id.parentNode.parentNode.parentNode.parentNode.parentNode
	t_tabl = t_cell.parentNode.parentNode.parentNode
	t_klas = t_tabl.className
	if(t_klas)
		if(	t_klas.indexOf("item")!=-1 && 
			t_klas.indexOf("Level")!=-1)
			if(	t_klas.substr(t_klas.length-2,t_klas.length-1)!="on" &&
				t_klas.substr(t_klas.length-2,t_klas.length-1)!="ov")
				t_tabl.className = t_klas + "ov"
}
function menu_out(id,lvl)
{
	if(id==null)	return
	if(lvl==null)	return
	t_cell = id.parentNode.parentNode.parentNode.parentNode.parentNode
	t_tabl = t_cell.parentNode.parentNode.parentNode
	t_klas = t_tabl.className
	if(t_klas)
		if(	t_klas.indexOf("item")!=-1 && 
			t_klas.indexOf("Level")!=-1)
			if(	t_klas.substr(t_klas.length-2,t_klas.length-1)!="on" &&
				t_klas.substr(t_klas.length-2,t_klas.length-1)=="ov")
				t_tabl.className = t_klas.substr(0,t_klas.length-2)
}
function menu_click(id,lvl)
{
	if(id==null)	return
	if(lvl==null)	return
	t_cell = id.parentNode.parentNode.parentNode.parentNode.parentNode
	t_tabl = t_cell.parentNode.parentNode.parentNode
	t_klas = t_tabl.className
	if(t_klas)
		if(	t_klas.indexOf("item")!=-1 && 
			t_klas.indexOf("Level")!=-1)
			if(	t_klas.substr(t_klas.length-2,t_klas.length-1)=="on")
				t_tabl.className = t_klas.substr(0,t_klas.length-2)+"ov"
   else
			if(	t_klas.substr(t_klas.length-2,t_klas.length-1)=="ov")
				t_tabl.className = t_klas.substr(0,t_klas.length-2)+"on"
			else
				t_tabl.className = t_klas+"on"
}
function button_over(id)
{
	if(id==null)	return
	if(id.src)		srs = id.src
	if(	srs.substr(srs.lastIndexOf(".")-3,3)!="_on" && 
		srs.substr(srs.lastIndexOf(".")-3,3)!="_ov")
		srs = srs.substr(0,srs.lastIndexOf("."))+"_ov"+srs.substring(srs.lastIndexOf("."),srs.length)
	id.src = srs
}
function button_out(id)
{
	if(id==null)	return
	if(id.src)		srs = id.src
	
	if(	srs.substr(srs.lastIndexOf(".")-3,3)!="_on" && 
		srs.substr(srs.lastIndexOf(".")-3,3)=="_ov")
		srs = srs.substr(0,srs.lastIndexOf(".")-3)+srs.substring(srs.lastIndexOf("."),srs.length)
	id.src = srs

	pom=srs
}
