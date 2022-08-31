// this function confirms if a user wants to delete an item
function confirmDelete()
{
    return confirm('Are you sure you want to delete this item?')  
}

// this function shows or hides a table
function showBLCS() 
{
    var x = document.getElementById("BLCS");
    if (x.style.display === "none") 
    {
        x.style.display = "block";
    } 
    else 
    {
        x.style.display = "none";
    }
}
