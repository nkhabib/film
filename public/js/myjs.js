$(".inputWithPreview").change(function(){
    var $input = $(this);
    var reader = new FileReader();
    reader.onload = function(){
        $(".imgPreview").attr("src", reader.result);
    }
    reader.readAsDataURL($input[0].files[0]);
});

new DataTable('#dataTable', {
    columnDefs: [
        {
            targets: [0],
            orderData: [0, 1]
        },
        {
            targets: [1],
            orderData: [1, 0]
        },
        {
            targets: [4],
            orderData: [4, 0]
        }
    ]
});