<style>
  /* Style the links inside the sidenav */
#mySidenav a {
  position: absolute; /* Position them relative to the browser window */
  left: -80px; /* Position them outside of the screen */
  transition: 0.3s; /* Add transition on hover */
  padding: 15px; /* 15px padding */
  width: 100px; /* Set a specific width */
  text-decoration: none; /* Remove underline */
  font-size: 20px; /* Increase font size */
  color: white; /* White text color */
  border-radius: 0 5px 5px 0; /* Rounded corners on the top right and bottom right side */
}

#mySidenav a:hover {
  left: 0; /* On mouse-over, make the elements appear as they should */
}

/* The about link: 20px from the top with a green background */
#about {
  top: 20px;
  background-color: #4CAF50;
}

#blog {
  top: 80px;
  background-color: #2196F3; /* Blue */
}

#projects {
  top: 140px;
  background-color: #f44336; /* Red */
}

#contact {
  top: 200px;
  background-color: #555 /* Light Black */
}
</style>
<div id="mySidenav" class="sidenav">
  @if()
</div>