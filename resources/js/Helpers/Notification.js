class Notification{

    success(){
        new Noty({
           type: 'success',
           layout: 'topRight',
           text: 'Successfully Added..!',
           timeout: 1000,
        }).show();
    }

    
    cart_success(){
        new Noty({
           type: 'success',
           layout: 'topRight',
           text: 'Successfully Added On Your Cart!',
           timeout: 1000,
        }).show();
    }

    order_success(){
        new Noty({
           type: 'success',
           layout: 'topRight',
           text: 'Your Order Successfully Completed!',
           timeout: 2000,
        }).show();
    }

    cart_remove(){
        new Noty({
           type: 'success',
           layout: 'topRight',
           text: 'Item Remove From Cart!',
           timeout: 1000,
        }).show();
    }




    update(){
        new Noty({
           type: 'success',
           layout: 'topRight',
           text: 'Successfully Data Updated..!',
           timeout: 1000,
        }).show();
    }

    alert(){
        new Noty({
           type: 'alert',
           layout: 'topRight',
           text: 'Are You Shure ?',
           timeout: 1000,
        }).show();
    }

    error(){
        new Noty({
           type: 'error',
           layout: 'topRight',
           text: 'Something Went Wrong',
           timeout: 1000,
        }).show();
    }

    warning(){
        new Noty({
           type: 'warning',
           layout: 'topRight',
           text: 'Opps..! ',
           timeout: 1000,
        }).show();
    }

    image_validation(){
        new Noty({
           type: 'error',
           layout: 'topRight',
           text: 'Opps..! image Should be less than 1 Mb ',
           timeout: 2000,
        }).show();
    }
}

export default Notification = new Notification()