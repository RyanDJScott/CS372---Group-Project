function deleteButtonCertain(event)
{
    if(!confirm("Are you sure you want to delete this user?"))
    {
        event.preventDefault();
    }
}