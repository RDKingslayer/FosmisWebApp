  	$(document).ready(function(){

      myFunction();      
      //hide fsc target group
      $(".target_group_fsc").hide();

    	//enable department dropdown
 	  	$('input[name=fsc]').click(function(){
            
         if($('input[name=fsc]:checked').val()=='other'){
         	//empty code input box 
         	$('#code').val('');

				$(".study_program").show();
            $(".dept").show();
            $("#department").prop('disabled', false);

            $(".target_group_fsc").hide();
         }else {

            myFunction();
            $(".dept").hide();
            $(".study_program").hide();
            $("#department").prop('disabled', true);

            var code=$('#code');
            code.val("FSC");

            $(".target_group_fsc").show();
         }

      });

      //hide maths subjects
      $(".Maths_subject").hide();

 	  	//autofill code input box
  		$('#department,#degree').change(function() {
  		$(".Maths_subject").hide();

  			var degree= $('#degree').val();
  			var department = $('#department').val();
  			var code=$('#code');
         if(department=="Botany")
         {
            switch(degree)  
            {             
               case 'BSc (General)':
               code.val("BOT"); 
               break;

               case 'BSc (Special) in Botany':
               code.val("BOT"); 
               break;
            }
         }

			else if(department=="Mathematics")
			{
				switch(degree)
  				{
               case 'BSc (General)':
                  if(degree=="BSc (General)")
                  {
                     $(".Maths_subject").show();

                     $('input[name=maths_subject]').click(function()
                     {
                        if($('input[name=maths_subject]:checked').val()=='MAT'){
                           code.val("MAT");
                        }else if($('input[name=maths_subject]:checked').val()=='AMT'){
                           code.val("AMT");
                        }
                        else{
                           code.val("IMT");
                        }
                     });   
                  }
                  else{}
               break;

               case 'BSc (Special) in Mathematics':
               code.val("MSP"); 
               break;
            }				
			}

  			else if(department=="Chemistry")
  			{
					switch(degree)
  					{
  					case 'BSc (General)':
					code.val("CHE"); 
					break;

               case 'BSc (Special) in Chemistry':
               code.val("CHE"); 
               break;

 					}
  			}
  			else if(department=="Computer Science")
  			{
					switch(degree)
  					{
  					case 'BSc (General)':
					code.val("COM"); 
					break;

               case 'BCS (General)':
               code.val("CSC"); 
               break;

               case 'BCS (Special)':
               code.val("CSC"); 
               break;
 					}		
  			}

  			else if(department=='Physics')
         {
               switch(degree)
               {
               case 'BSc (General)':
               code.val("PHY"); 
               break;

               case 'BSc (Special) in Physics':
               code.val("PHY"); 
               break;
               }
         }

         else if(department=='Zoology')
         {
               switch(degree)
               {
               case 'BSc (General)':
               code.val("ZOO"); 
               break;

               case 'BSc (Special) in Zoology':
               code.val("ZOO"); 
               break;
               }
         }

         else
         {
               switch(degree)
               {
               case 'BSc (General)':
               code.val("ENG"); 
               break;

               case 'BSc (Special)':
               code.val("ENG"); 
               break;
               
               case 'BCS (General)':
               code.val("ENG"); 
               break;
               
               case 'BSc (Special) in Zoology':
               code.val("ZOO"); 
               break;

               case 'BSc (Special) in Physics':
               code.val("ENG"); 
               break;

               case 'BSc (Special) in Chemistry':
               code.val("ENG"); 
               break;

               case 'BSc (Special) in Mathematics':
               code.val("ENG"); 
               break;

               case 'BSc (Special) in Botany':
               code.val("ENG"); 
               break;
               }           
         }
  		}); 
      		
      function myFunction() {
  		$(".dept").hide();
  		$(".target_group_general").hide();
      $(".All_Stream").hide();
  		$(".pathways_general").hide();
  		$(".target_group_special").hide();
  		$(".pathways_special").hide();
  		$(".Prerequisite_course_code").hide();
      }
  		//enable target groups of general degree
  	  $('#degree').change(function() {
      
      var degree= $('#degree').val(); 
     
         if((degree=="BSc (General)")||(degree=="BCS (General)")){
            $(".target_group_general").show();
            $(".target_group_special").hide();
            $(".pathways_special").hide();

            $('#bsc').click(function(){
               $(".All_Stream").show();
            	$(".target_group_special").hide();
            	if( $("#bsc").is(":checked")){
            		$(".pathways_general").show();	

            			$('#all_ps').click(function(){ 
            			$(".target_group_special").hide();           				
            				if( $("#all_ps").is(":checked")){
            					$( "#ps1" ).prop( "checked", true);	//	$("#ps1").attr("disabled", true);
									$( "#ps2" ).prop( "checked", true);	//$("#ps2").attr("disabled", true);
									$( "#ps3" ).prop( "checked", true);	//$("#ps3").attr("disabled", true);
									$( "#ps4" ).prop( "checked", true);	//$("#ps4").attr("disabled", true);									
            				}
            				else{
            					$( "#ps1" ).prop( "checked", false);	$("#ps1").attr("disabled", false);
									$( "#ps2" ).prop( "checked", false);	$("#ps2").attr("disabled", false);
									$( "#ps3" ).prop( "checked", false);	$("#ps3").attr("disabled", false);
									$( "#ps4" ).prop( "checked", false);	$("#ps4").attr("disabled", false);
            				}
            			});            			

            			$('#all_bs').click(function(){
            			$(".target_group_special").hide();            				
            				if( $("#all_bs").is(":checked")){
            					$( "#bs1" ).prop( "checked", true);	//$("#bs1").attr("disabled", true);
									$( "#bs2" ).prop( "checked", true);	//$("#bs2").attr("disabled", true);
									$( "#bs3" ).prop( "checked", true);	//$("#bs3").attr("disabled", true);									
            				}
            				else{
            					$( "#bs1" ).prop( "checked", false);	$("#bs1").attr("disabled", false);
									$( "#bs2" ).prop( "checked", false);	$("#bs2").attr("disabled", false);
									$( "#bs3" ).prop( "checked", false);	$("#bs3").attr("disabled", false);
            				}
            			});
            	}
            	else{
            		$(".pathways_general").hide();
	           	}
            });	

         }else {
            $(".target_group_general").hide();
            $(".pathways_general").hide();
				
				//enable target groups of special degree
            $(".target_group_special").show();

            	$('#bsc_spe').click(function(){
            		if( $("#bsc_spe").is(":checked")){
							$(".pathways_special").show();
            		}
            		else{
 							$(".pathways_special").hide();
            		}	
            	});
         }
      });
		
		// radio button core/optional for bcs general
		$('#bcs').bind("keyup change", function() { 
			if( $("#bcs").is(":checked")){
			   $("#c_o_bcs").prop('required',true);	
			}
			else{
				$("#c_o_bcs").prop('required',false);
			}
		}); 

		// radio button core/optional for bsc general
		$('#bsc').bind("keyup change", function() { 
			$('#all_ps').bind("keyup change", function(){
				if( $("#all_ps").is(":checked")){
			   	$("#c_o_ps").prop('required',true);	
				}
				else{
			 		$("#c_o_ps").prop('required',false);	
			 	}
			});  

			$('#all_bs').bind("keyup change", function(){
				if( $("#all_bs").is(":checked")){
			   	$("#c_o_bs").prop('required',true);	
				}
				else{
			 		$("#c_o_bs").prop('required',false);	
			 	}
			});    
		});

      // radio button core/optional for bcs special
      $('#bcs_spe').bind("keyup change", function() { 
         if( $("#bcs_spe").is(":checked")){
            $("#c_o_bcs_spe").prop('required',true);   
         }
         else{
            $("#c_o_bcs_spe").prop('required',false);
         }
      });

      // radio button core/optional for bcs special
      $('#bsc_spe').bind("keyup change", function() { 
         if( $("#bsc_spe").is(":checked")){
            $("#c_o_bsc_spe").prop('required',true);   
         }
         else{
            $("#c_o_bsc_spe").prop('required',false);
         }
      });

  		//split semester, level, credits from course code
		$('#code').bind("keyup change", function() { 

  		var level=$('#level');
  		var semester=$('#semester');
  		var credits=$('#credits');
		var code=$('#code').val();

  		var res_semester= code.substr(4,1);
  		var res_level= code.substr(3,1);
  		var res_credits= code.substr(6,1);

    	semester.val(res_semester);
    	level.val(res_level);

    	if(res_credits=="a"){
    	credits.val(1.5);	
    	}
    	else if(res_credits=="b"){
    	credits.val(2.5);
    	}
    	else if(res_credits=="d"){
    	credits.val(1.25);
    	}
    	else{
    	credits.val(res_credits);
    	}

		});	

		//Prerequisites
 	  	$('input[name=Prerequisites]').click(function(){
            
         if($('input[name=Prerequisites]:checked').val()=='yes'){
         	//empty Prerequisite course code input box 
         	$('#Prerequisite_code').val('');
				$("#Prerequisite_code").prop('disabled', false);
            $(".Prerequisite_course_code").show();

         }else {
            $(".Prerequisite_course_code").hide();
            $("#Prerequisite_code").prop('disabled', true);
         }
      });		
         
	});

