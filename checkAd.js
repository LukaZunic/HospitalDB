function checkAd(user){
    if(user == "admin"){
        document.getElementById("ad").innerHTML = '<a href="signUp.php">Add New User</a><a href="newPatient.php">Add New Patient</a>';
        document.getElementById("con").innerHTML = '<a href="logout.php">Log Out</a><a href="index.php">Contacts</a>';
    }else{
        document.getElementById("con").innerHTML = '<a href="logout.php">Log Out</a><a href="index.php">Contacts</a>';
    }
}