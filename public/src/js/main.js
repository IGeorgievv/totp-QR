$(function(){

    function BaseTools( settings ) {
        var $this = this;
        var cache = {};

        this.init = function () {
            $this.formFields();
        }

        this.formFields = function() {
            $(document).on('click.form', '.form-field', function() {
                if ( !cache[this] )
                    cache[this] = {};

                cache[this]['value'] =  this.value;
                this.value = "";
            });
            $(document).on('focusout.form', '.form-field', function() {
                
                if ( !this.value )
                    this.value = cache[this]['value'];
            });
        }
    }

    new BaseTools( {} ).init();
});
