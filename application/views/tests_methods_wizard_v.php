<html>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <body>
        <form id = "methods" class = "method_samthing"  >
            <?php foreach ($tests as $test) { ?>
                <fieldset>
                    <legend class = "small-text"><?php echo $reqid; ?>&nbsp;|&nbsp;<?php echo $sample_info[0]['Clients']['Name']; ?></legend>
                    <span class = "smalltext misc_text" ><?php echo $sample_info[0]['product_name']; ?>&nbsp;|&nbsp;Choose method for <?php echo $test['Name'] ?></span>
                    <hr>
                    <?php if(count($components) > 1 && ($test['id'] == 2 || $test['id'] == 5 )) { foreach ($components as $component){  ?>
                    <span class = "smalltext misc_text"><?php echo $component['component'] ?></span>
                    <ul  class = "no_style" >
                        <?php foreach ($test['Test_methods'] as $method) { ?>
                            <li id ="method-<?php echo $method['id'] ?>"  > 
                                <label for = "<?php echo $method['id'] ?>" >
                                    <input class = "methodRadios"  type = "radio" data-name = "<?php echo $method['name'] ?>" name = "methods_<?php echo $component['component']; ?>_<?php echo $test['id']; ?>" value = "<?php echo $method['id'] ?>" title = "<?php echo $method['name'] ?>"  data-test = "<?php echo $method['test_id'] ?>"  />
                                    <?php echo $method['name'] ?>&nbsp;<span class ="charge" id ="charges<?php echo $method['id']; ?>" ></span>
                                </label>
                            </li>
                            <script>
                                //Format values as currency
                                 formattedMoney = accounting.formatMoney("<?php echo $method['charge']; ?>",{ symbol:"KES", format: "%s %v" } );
                                 $("#charge<?php echo $method['id']?>").text(formattedMoney);
                            </script>	
                        <?php } ?>
                    </ul>
                    <?php } } else {?>
                        <ul  class = "no_style" >
                        <?php foreach ($test['Test_methods'] as $method) { ?>
                            <li id ="method-<?php echo $method['id'] ?>"  > 
                                <label for = "<?php echo $method['id'] ?>" >
                                    <input class = "methodRadios"  type = "radio" data-name = "<?php echo $method['name'] ?>" name = "methods_<?php echo $test['id']; ?>" value = "<?php echo $method['id'] ?>" title = "<?php echo $method['name'] ?>"  data-test = "<?php echo $method['test_id'] ?>"  />
                                    <?php echo $method['name'] ?>&nbsp;<span class ="charge" id ="charges<?php echo $method['id']; ?>" ></span>
                                </label>
                            </li>
                            <script>
                                //Format values as currency
                                 formattedMoney = accounting.formatMoney("<?php echo $method['charge']; ?>",{ symbol:"KES", format: "%s %v" } );
                                 $("#charge<?php echo $method['id']?>").text(formattedMoney);
                            </script>   
                        <?php } ?>
                    </ul>
                     <?php } ?>
                    <input type = "hidden" name ="tests[]" value = "<?php echo $test['id'] ?>" />
                </fieldset>
            <?php } ?>
        </form>
    </body>
</html>

<script type = "text/javascript" >
    $(function() {

    //Assign Jwizard configurations/initialization options to a variable.    
            $('#methods').jWizard({
                menu: false,
                finishButtonType: 'submit'
            });


    //Submit #methods form data
            $('#methods').submit(function(e) {
                e.preventDefault();
                var saveMethods_href = '<?php echo base_url() . "tests_management/updateClientBilling/" . $reqid . "/". $table ?>';
                $.ajax({
                    type: 'POST',
                    url: saveMethods_href,
                    data: $('#methods').serialize(),
                    dataType: "json"
                }).done(function(response) {
                    var table = '<?php echo $table; ?>';
                    var components_count ='<?php echo $components_count ?>';
                    console.log(components_count);
                        //If sample is multicomponent, redirect to page to choose system of payment
                        if(components_count > 1){
                            href = '<?php echo base_url()."quotation/chooseSystem/$reqid/$table/$table2/$table3/$client_id" ?>'
                        }
                        else{
                            href = '<?php echo base_url()."client_billing_management/showBillPerTest/$reqid/$table/$table2/$table3/$client_id" ?>' 
                        }

                        //If executing from quotations without request id or for sample with request id
                       // if(table != 'request'){
                       //$.fancybox.close();
                        var this_page = '<?php echo base_url() . "request_management" ?>'
                        console.log(table);
                        console.log(href);
                        //parent.location.href = this_page;
                   /* }
                    else{ */
                        parent.$.fancybox.open({
                            href:href,
                            type: 'iframe',
                            autoSize:false,
                            autoDimensions:false,
                            width:700,
                            height:490,
                            'beforeClose':function(){
                                //getData();
                            }
                         })
                    //}
                }).fail({
                });
            })

        })
</script>