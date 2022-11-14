let profileboxState = false;
let alreadyCalled = false;
let rotated = false;

function tweakProfilebox()
{
	if(profileboxState == true){
		profileboxState = false;
		document.getElementById("nav-profile-box-div").style.display = "none";
	}else{
		profileboxState = true;	
		document.getElementById("nav-profile-box-div").style.display = "block";
	}
	alreadyCalled = true;
}

document.getElementById('profile-box').addEventListener('click', function handleProfileClicked(){
	tweakProfilebox();
});

document.addEventListener('click', function handleClicked(){
	if(alreadyCalled){
		alreadyCalled = false;
	}
	else{
		if(profileboxState == true)
			tweakProfilebox();	
	}
});

document.getElementById("cog").addEventListener('mouseover', function paramHover(){
	if(rotated == false)
	{
		document.getElementById('cog').style.transform = 'rotate(20deg)';
		rotated = true;
	}
		
});

document.getElementById("cog").addEventListener('mouseout', function paramHover(){
	if(rotated == true){
		document.getElementById('cog').style.transform = 'rotate(0deg)';
		rotated = false;
	}
});