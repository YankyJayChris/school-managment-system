$(function(){
    //add active link on menu
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if(filename){
        $('.side-nav li').removeClass('active'); 
    }
    $('.side-nav li a[href="'+filename+'"]').parent("li").addClass('active');
    
    //confirmation when click
    $('.confirmation').on('click',function(){
        var confirmation = confirm('Are you sure to delete this RECORD');
        if(confirmation){
            return true;   
        }
        return false;
    });
    
    //confirm adding acc
    $('.confirmacc').on('click',function(){
        var confirmation = confirm('Create LOGIN ACCOUNT?');
        if(confirmation){
            return true;   
        }
        return false;
    });
    
});