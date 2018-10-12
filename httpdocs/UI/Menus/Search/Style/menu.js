function button_over(id)
{
	if(id==null)
		return
	if(id.src)
		srs = id.src
	if(	srs.substr(srs.lastIndexOf(".")-3,3)!="_on" && 
		srs.substr(srs.lastIndexOf(".")-3,3)!="_ov")
		srs = srs.substr(0,srs.lastIndexOf("."))+"_ov"+srs.substring(srs.lastIndexOf("."),srs.length)
	id.src = srs
}

function button_out(id)
{
	if(id==null)
		return
	if(id.src)
		srs = id.src
	if(	srs.substr(srs.lastIndexOf(".")-3,3)!="_on" && 
		srs.substr(srs.lastIndexOf(".")-3,3)=="_ov")
		srs = srs.substr(0,srs.lastIndexOf(".")-3)+srs.substring(srs.lastIndexOf("."),srs.length)
	id.src = srs
}
