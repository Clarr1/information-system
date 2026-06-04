@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: @json(session('success')),
    confirmButtonColor: '#3085d6'
});
</script>
@endif

@if(session('purchase_success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: @json(session('purchase_success')),
    confirmButtonColor: '#3085d6'
});
</script>
@endif

{{-- for update --}}
@if(session('updated'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: @json(session('updated')),
    confirmButtonColor: '#3085d6'
});
</script>
@endif

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
        }
    });
}
</script>