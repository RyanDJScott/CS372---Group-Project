function deleteButtonCertain(event)
{
    if(!confirm("Are you sure you want to perform this deletion? All information will be permanently lost!"))
    {
        event.preventDefault();
    }
}