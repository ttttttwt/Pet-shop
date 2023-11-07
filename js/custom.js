function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(400)
                .height(500);
        };

        reader.readAsDataURL(input.files[0]);
    };
};


$('.amount').change(function (e) {
    // e.preventDefault();

    var amount = $(this).val();
    var total = $(this).parent().parent().find('.total').text();
    var price = $(this).parent().parent().find('.price').text();
    var id = $(this).parent().parent().find('.id').html();
    var total = amount * price;
    $(this).parent().parent().find('.total').text(total);
    window.location.href = "update_amount.php?amount=" + amount + "&id=" + id;

});

function toNext(start, limt, category = null, sortby = null, search = null) {


    if (category == null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt;
    } else if (category != null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category;
    } else if (category == null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby;
    } else if (category == null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&search=' + search;
    } else if (category != null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby;
    } else if (category != null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&search=' + search;
    } else if (category == null && sortby != null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby + '&search=' + search;
    } else {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby + '&search=' + search;
    }

};

function toPrev(start, limt, category = null, sortby = null, search = null) {

    if (category == null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt;
    } else if (category != null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category;
    } else if (category == null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby;
    } else if (category == null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&search=' + search;
    } else if (category != null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby;
    } else if (category != null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&search=' + search;
    } else if (category == null && sortby != null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby + '&search=' + search;
    } else {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby + '&search=' + search;
    }

};

function toPage(start, limt, category = null, sortby = null, search = null) {

    if (category == null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt;
    } else if (category != null && sortby == null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category;
    } else if (category == null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby;
    } else if (category == null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&search=' + search;
    } else if (category != null && sortby != null && search == null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby;
    } else if (category != null && sortby == null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&search=' + search;
    } else if (category == null && sortby != null && search != null) {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&sortby=' + sortby + '&search=' + search;
    } else {
        window.location.href = 'shop.php?start=' + start + '&limit=' + limt + '&category=' + category + '&sortby=' + sortby + '&search=' + search;
    }


};

function search(input, category = null, sortby = null) {
    var search = input.value;
    // console.log(search);
    if (category == null && sortby == null) {
        window.location.href = 'shop.php?search=' + search + '&start=0&limit=9';
    } else if (category != null && sortby == null) {
        window.location.href = 'shop.php?search=' + search + '&category=' + category + '&start=0&limit=9';
    } else if (category == null && sortby != null) {
        window.location.href = 'shop.php?search=' + search + '&sortby=' + sortby + '&start=0&limit=9';
    } else {
        window.location.href = 'shop.php?search=' + search + '&category=' + category + '&sortby=' + sortby + '&start=0&limit=9';
    }
    

}



