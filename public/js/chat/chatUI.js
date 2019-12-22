$(document).ready(function(){
    $('.emoji-btn').on('click',function(){
        $('.emojiContainer').toggle();
    });
    $('.emoji_item').on('click', function(){
        var emoji_value = $(this).text();
        $("#write_msg").val(function() {
            return this.value + emoji_value;
        });
    });
});