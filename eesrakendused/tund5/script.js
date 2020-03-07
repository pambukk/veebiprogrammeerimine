$(document).ready(function(){
    $('#picContainer img').css({'width':'20vw'});

    let firstPic = $('.active').attr('src');

    $('.big-image').html('<img src='+ firstPic +'>');
    $('.big-image img').css({'width':'90vw'});

    $('#next').click(forward);
    $('#prev').click(backward);
    $('#hide').click(hidePic);
    $(document).keydown(function(event){
        console.log(event.keyCode);
        if(event.keyCode == 37){
            backward();
        }
        if(event.keyCode == 39){
            forward();
        }
    });

    function backward(){
        let currentPic = $('.active');
        let selectedPic = currentPic.prev();
        console.log(selectedPic);
        if(selectedPic.length == 0){
            selectedPic = $('#picContainer img').siblings().last();
        }
        selectedPic.addClass('active');
        currentPic.removeClass('active');

        $('.big-image').html('<img src='+ selectedPic.attr('src') +'>').hide().fadeIn(1500).fadeOut(1000).slideDown(2000); 
        $('.big-image img').css({'width':'90vw'});
    }

    function forward(){
        let currentPic = $('.active');
        let selectedPic = currentPic.next();
        console.log(selectedPic);
        if(selectedPic.length == 0){
            selectedPic = $('#picContainer img').siblings().first();
        }
        selectedPic.addClass('active');
        currentPic.removeClass('active');

        $('.big-image').html('<img src='+ selectedPic.attr('src') +'>').hide().fadeIn(1500).fadeOut(1000).slideDown(2000); 
        $('.big-image img').css({'width':'90vw'});
    }

    function hidePic(){
        $('.big-image-container').fadeToggle("step");
        console.log();
        //if(selectedPic.length == 0){
        //    hide.innerHTML = 'Näita';
        //}
        //if(selectedPic.length > 0){
        //    hide.innerHTML = 'Peida';
        //}
        //hide.innerHTML = 'Näita';
        //else hide.innerHTML = 'Peida';
    

    }
});