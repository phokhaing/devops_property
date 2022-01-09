var baseUrl = global_base_url+'loan/address/';
    
    /**
     * ----------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @date  : 15/07/2020
     * @param : find customer address
     * ----------------------------------------------
     */

    /* list province by country id */
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'GET',
                url: baseUrl+'findProvince/'+countryID,
                success:function(html){
                    $('#province_dropdown').html(html);
                    $('#district_dropdown').html('<option value="">Select province first</option>');
                }
            });
        }else{
           	$("#province_dropdown").html("<option value=''>---Select Province---</option>");
    		$("#district_dropdown").html("<option value=''>---Select District---</option>");
    		$("#commune_dropdown").html("<option value=''>---Select Commune---</option>");
    		$("#village_dropdown").html("<option value=''>---Select Village---</option>");
        }
    });

    /* list district by province id */
    $('#province_dropdown').on('change',function(){
        var proID = $(this).val();
        if(proID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findDistrict/'+proID,
                success:function(html){
                    $('#district_dropdown').html(html);
                }
            });
        }else{
            $('#district_dropdown').html('<option value="">select province first</option>');
        }
    });

    /* list commune by district id */
    $('#district_dropdown').on('change',function(){
        var districtID = $(this).val();
        if(districtID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findCommune/'+districtID,
                success:function(html){
                    $('#commune_dropdown').html(html);
                }
            });
        }else{
            $('#commune_dropdown').html('<option value="">select district first</option>');
        }
    });

    /* list village by commune id */
    $('#commune_dropdown').on('change',function(){
        var communeID = $(this).val();
        if(communeID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findVillage/'+communeID,
                success:function(html){
                    $('#village_dropdown').html(html);
                }
            });
        }else{
            $('#village_dropdown').html('<option value="">select commune first</option>');
        }
    });


    /**
     * ----------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @date  : 15/07/2020
     * @param : find customer contact address
     * ----------------------------------------------
     */

    /* list province by country id */
    function selectCountry(num){
        var countryID = $('#country_id'+num).val();
        if(countryID){
            $.ajax({
                type:'GET',
                url: baseUrl+'findProvince/'+countryID,
                success:function(html){
                    $('#province_id'+num).html(html);
                    $('#district_id'+num).html('<option value="">Select province first</option>');
                }
            });
        }else{
            $("#province_id"+num).html("<option value=''>---Select Province---</option>");
            $("#district_id"+num).html("<option value=''>---Select District---</option>");
            $("#commune_id"+num).html("<option value=''>---Select Commune---</option>");
            $("#village_id"+num).html("<option value=''>---Select Village---</option>");
        }
    }

    /* list district by province id */
    function selectProvince(num){
        var proID =  $('#province_id'+num).val();
        if(proID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findDistrict/'+proID,
                success:function(html){
                    $('#district_id'+num).html(html);
                }
            });
        }else{
            $('#district_id'+num).html('<option value="">select province first</option>');
        }
    }

    /* list commune by district id */
    function selectDistrict(num){
        var districtID =  $('#district_id'+num).val();
        if(districtID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findCommune/'+districtID,
                success:function(html){
                    $('#commune_id'+num).html(html);
                }
            });
        }else{
            $('#commune_id'+num).html('<option value="">select district first</option>');
        }
    }

    /* list village by commune id */
    function selectCommune(num){
        var communeID =  $('#commune_id'+num).val();
        if(communeID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findVillage/'+communeID,
                success:function(html){
                    $('#village_id'+num).html(html);
                }
            });
        }else{
            $('#village_id'+num).html('<option value="">select commune first</option>');
        }
    }


    /**
     * ----------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @date  : 15/07/2020
     * @param : find employment detail address
     * ----------------------------------------------
     */

    /* list province by country id */
    function selectEmployerCountry(num){
        var countryID = $('#employer_country'+num).val();
        if(countryID){
            $.ajax({
                type:'GET',
                url: baseUrl+'findProvince/'+countryID,
                success:function(html){
                    $('#employer_province'+num).html(html);
                    $('#employer_district'+num).html('<option value="">Select province first</option>');
                }
            });
        }else{
            $("#employer_province"+num).html("<option value=''>---Select Province---</option>");
            $("#employer_district"+num).html("<option value=''>---Select District---</option>");
            $("#employer_commune"+num).html("<option value=''>---Select Commune---</option>");
            $("#employer_village"+num).html("<option value=''>---Select Village---</option>");
        }
    }

    /* list district by province id */
    function selectEmployerProvince(num){
        var proID =  $('#employer_province'+num).val();
        if(proID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findDistrict/'+proID,
                success:function(html){
                    $('#employer_district'+num).html(html);
                }
            });
        }else{
            $('#employer_district'+num).html('<option value="">select province first</option>');
        }
    }

    /* list commune by district id */
    function selectEmployerDistrict(num){
        var districtID =  $('#employer_district'+num).val();
        if(districtID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findCommune/'+districtID,
                success:function(html){
                    $('#employer_commune'+num).html(html);
                }
            });
        }else{
            $('#employer_commune'+num).html('<option value="">select district first</option>');
        }
    }

    /* list village by commune id */
    function selectEmployerCommune(num){
        var communeID =  $('#employer_commune'+num).val();
        if(communeID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findVillage/'+communeID,
                success:function(html){
                    $('#employer_village'+num).html(html);
                }
            });
        }else{
            $('#employer_village'+num).html('<option value="">select commune first</option>');
        }
    }

    /**
     * ----------------------------------------------
     * @author: khaing.pho1991@gmail.com
     * @date  : 15/07/2020
     * @param : find business location address
     * ----------------------------------------------
     */

    /* list province by country id */
    function selectBusinessCountry(num){
        var countryID = $('#business_country'+num).val();
        if(countryID){
            $.ajax({
                type:'GET',
                url: baseUrl+'findProvince/'+countryID,
                success:function(html){
                    $('#business_province'+num).html(html);
                    $('#business_district'+num).html('<option value="">Select province first</option>');
                }
            });
        }else{
            $("#business_province"+num).html("<option value=''>---Select Province---</option>");
            $("#business_district"+num).html("<option value=''>---Select District---</option>");
            $("#business_commune"+num).html("<option value=''>---Select Commune---</option>");
            $("#business_village"+num).html("<option value=''>---Select Village---</option>");
        }
    }

    /* list district by province id */
    function selectBusinessProvince(num){
        var proID =  $('#business_province'+num).val();
        if(proID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findDistrict/'+proID,
                success:function(html){
                    $('#business_district'+num).html(html);
                }
            });
        }else{
            $('#business_district'+num).html('<option value="">select province first</option>');
        }
    }

    /* list commune by district id */
    function selectBusinessDistrict(num){
        var districtID =  $('#business_district'+num).val();
        if(districtID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findCommune/'+districtID,
                success:function(html){
                    $('#business_commune'+num).html(html);
                }
            });
        }else{
            $('#business_commune'+num).html('<option value="">select district first</option>');
        }
    }

    /* list village by commune id */
    function selectBusinessCommune(num){
        var communeID =  $('#business_commune'+num).val();
        if(communeID){
            $.ajax({
                type:'GET',
                url:baseUrl+'findVillage/'+communeID,
                success:function(html){
                    $('#business_village'+num).html(html);
                }
            });
        }else{
            $('#business_village'+num).html('<option value="">select commune first</option>');
        }
    }