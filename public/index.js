function startQuote() {
    $.ajax({
        url : '/quotation.php',
        type : 'GET',
        dataType:'json',
        success : function(data) {
            const { token } = data ;
            localStorage.setItem('token', token);
            $("#start-quotation").hide();
            $("#quotation-form").show();
        },
        error : function(data) {
            console.error(data);
        }
    });
}

function addNewGuest() {
    $("#guests-container").append('<div class="input-group mb-3  optional-guest-container">\n' +
        '                    <input type="number" class="form-control" placeholder="Enter your secondary guest age" name="age-optional" required>\n' +
        '                    <div class="input-group-append">\n' +
        '                        <button class="input-group-text" type="button" onclick="removeGuest(this)">Remove</button>\n' +
        '                    </div>\n' +
        '                </div>');
}

function removeGuest(event) {
    let guestContainer = $(event).closest('.optional-guest-container');

    if (guestContainer.length > 0) {
        guestContainer[0].remove();
    }
}

function getFormattedCurrentDat() {
    let today = new Date(),
        day = today.getDate(),
        month = today.getMonth()+1,
        year = today.getFullYear();
    if(day<10){
        day='0'+day
    }
    if(month<10){
        month='0'+month
    }
    today = year+'-'+month+'-'+day;

    return today.toString();
}