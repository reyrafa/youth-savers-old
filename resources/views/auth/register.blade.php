<!DOCTYPE html>
<html lang="en">

<head>
  @include('includes.head')

  <script>
    $(document).ready(function() {

      //multi-step registration
      $('#nxtBtnPerInfo').on('click', function() {
        var firstname = document.getElementById('firstname').value
        var lastname = document.getElementById('lastname').value
        var middlename = document.getElementById('middlename').value
        var birthdate = document.getElementById('date_of_birth').value
        var gender = document.getElementById('gender').value
        var home_address = document.getElementById('home_address').value
        var contact_no = document.getElementById('contact_no').value
        var branch = document.getElementById('branch_id').value
        var branch_under = document.getElementById('branch_under_id').value
        if (firstname == '' || lastname == '' || middlename == '' || birthdate == '' || gender == '' || home_address == '' || contact_no == '' || branch == '' || branch_under == '') {

        } else {
          $('#step1').removeClass("current-item")
          $('#step2').addClass("current-item")
          $('.PerInfo').hide()

          $('.GuardInfo').show()


        }

      })

      //validate phone number
      $('#contact_no').on('keyup', function() {
        var contactNo = this.value

        if (contactNo.length < 11) {
          $('#contact_noError').show();
          $('#nxtBtnPerInfo').attr('disabled', 'disabled');
        } else {
          $('#contact_noError').hide();
          $('#nxtBtnPerInfo').removeAttr('disabled');
        }
      })

      //2 guardian back
      $('#guardBckBtn').on('click', function() {
        $('.PerInfo').show()
        $('.GuardInfo').hide()
        $('#step2').removeClass("current-item")
        $('#step1').addClass("current-item")
      })

      //guardian next
      $('#guardNxtBtn').on('click', function() {
        var firstname = document.getElementById('guardian_firstname').value
        var lastname = document.getElementById('guardian_lastname').value
        var middlename = document.getElementById('guardian_middlename').value
        var birthdate = document.getElementById('guardian_date_of_birth').value
        var gender = document.getElementById('guardian_gender').value
        var home_address = document.getElementById('guardian_home_address').value
        var contact_no = document.getElementById('guardian_contact_no').value
        var present_address = document.getElementById('guardian_present_address').value
        var relation = document.getElementById('guardian_relationship_to_depositor').value
        var civil_status = document.getElementById('guardian_civil_status').value
        var oic_member = document.getElementById('guardian_oic_member').value
        if (firstname == '' || lastname == '' || middlename == '' || birthdate == '' || gender == '' || home_address == '' || contact_no == '' || present_address == '' || relation == '' || civil_status == '' || oic_member == '') {

        } else {
          $('#step2').removeClass("current-item")
          $('#step3').addClass("current-item")
          $('.GuardInfo').hide()

          $('.ReferInfo').show()


        }

      })

      //refererence back
      $('#referBckBtn').on('click', function() {
        $('.GuardInfo').show()
        $('.ReferInfo').hide()
        $('#step3').removeClass("current-item")
        $('#step2').addClass("current-item")
      })

      //reference skip
      $('#referSkipBtn').on('click', function() {
        $('.uploadDocu').show()
        $('.ReferInfo').hide()
        $('#step3').removeClass("current-item")
        $('#step4').addClass("current-item")
      })

      //reference next
      $('#referNxtBtn').on('click', function() {
        $('.uploadDocu').show()
        $('.ReferInfo').hide()
        $('#step3').removeClass("current-item")
        $('#step4').addClass("current-item")

      })

      //upload back 
      $('#uploadBackBtn').on('click', function() {
        $('.ReferInfo').show()
        $('.uploadDocu').hide()
        $('#step4').removeClass("current-item")
        $('#step3').addClass("current-item")
      })

      //upload next
      $('#uploadNxtBtn').on('click', function() {

        var signature = document.getElementById('signature').value
        var ID = document.getElementById('ID').value
        var birth = document.getElementById('birth_certificate').value

        if (signature == '' || ID == '' || birth == '') {

        } else {
          $('.uploadDocu').hide()
          $('.loginInfo').show()
          $('#step4').removeClass("current-item")
          $('#step5').addClass("current-item")
        }

      })

      //login back
      $('#loginBackBtn').on('click', function() {
        $('.uploadDocu').show()
        $('.loginInfo').hide()
        $('#step5').removeClass("current-item")
        $('#step4').addClass("current-item")
      })




      //getting value of branch when selected
      $('#branch_id').on('change', function() {
        var id = this.value
        var op = " "
        var div = $(this).parent().parent()


        $.ajax({
          type: 'get',
          url: '{!!URL::to("findBranchUnder")!!}',
          data: {
            'id': id
          },
          success: function(data) {
            console.log(data.length)
            op += '<option value="0" selected disabled>--Select Branch--</option>'
            for (var i = 0; i < data.length; i++) {
              op += '<option value ="' + data[i].id + '">' + data[i].
              branch_name + '</option>'
            }
            div.find('.branch_name').html(" ")

            div.find('.branch_name').append(op)
          },
          error: function(error) {
            console.log("fails")
            console.log(JSON.stringify(error))
          }

        })
      })

      //getting value of branch when selected
      $('#branch_idR').on('change', function() {
        var id = this.value
        var op = " "
        var div = $(this).parent().parent()


        $.ajax({
          type: 'get',
          url: '{!!URL::to("findBranchUnder")!!}',
          data: {
            'id': id
          },
          success: function(data) {
            console.log(data.length)
            op += '<option value="0" selected disabled>--Branch Under--</option>'
            for (var i = 0; i < data.length; i++) {
              op += '<option value ="' + data[i].id + '">' + data[i].
              branch_name + '</option>'
            }
            div.find('.branch_nameR').html(" ")

            div.find('.branch_nameR').append(op)
          },
          error: function(error) {
            console.log("fails")
            console.log(JSON.stringify(error))
          }

        })
      })


      //terms and policy
      $('#termsPolicy').on('click', function() {
        swal("Terms and Policy!");
      })

      $('#Privacy_popup').on('click', function() {
        swal("Privacy!");
      })


      //validating the user Id -- should be unique
      //$('#user_id').keyup(function(){
      // var variable = this.value
      //  $.ajax({
      //    type: 'get',
      //    url: '{!!URL::to("validateUserId")!!}',
      //    data: {'id':variable},
      //    success: function(data){
      //      //console.log("success")
      //      //console.log(data)
      //      if(data.length >= 1){
      //        $('#submit').attr('disabled', 'disabled')
      //       $('#CustomerIdError').show()
      //      }
      //      else{
      //        $('#CustomerIdError').hide()
      //        $('#submit').removeAttr('disabled')
      //      }
      //    },
      //    error: function(error){
      //      console.log("fails");
      //      console.log(JSON.stringify(error))
      //    }
      //  })
      //})


      //validating the birthdate
      $('#date_of_birth').on('change', function() {
        d = new Date($('#date_of_birth').val())

        birthdate_year = d.getFullYear()
        current_year = (new Date()).getFullYear();

        age = current_year - birthdate_year;
        if (age >= 7 && age <= 17) {
          $('#age_error').hide();
          $('#nxtBtnPerInfo').removeAttr('disabled')

        } else {
          $('#age_error').show();
          $('#submit').attr('disabled', 'disabled')
          $('#nxtBtnPerInfo').attr('disabled', 'disabled')
        }

      })

      //validating the full name
      /**    $('#firstname').keyup(function(){
          var data = this.value
          $.ajax({
            type: 'get',
            url:'{{!!URL::to("validateFullName")!!}}',
            data: {'id':data},
            success: function(data){
              console.log("success")
              console.log(data)
            },
            error: function(error){
              console.log("fails")
              console.log(JSON.stringify(error))
            }
          })
        })**/

      //validating the retype user id
      $('#reuser_id').keyup(function() {
        var userID = $('#user_id').val()
        var reuserID = $('#reuser_id').val()
        if (userID != reuserID) {
          $('#submit').attr('disabled', 'disabled')
          $('#reCustomerIdError').show()
        } else {
          $('#reCustomerIdError').hide()
          $('#submit').removeAttr('disabled')
        }
      })

      //validating the email -- should be unique  
      $('#email').keyup(function() {
        var variable = this.value
        $.ajax({
          type: 'get',
          url: '{!!URL::to("validateUserEmail")!!}',
          data: {
            'id': variable
          },
          success: function(data) {
            console.log("success")
            console.log(data)
            if (data.length >= 1) {
              $('#submit').attr('disabled', 'disabled')
              $('#emailError').show()
            } else {
              $('#emailError').hide()
              $('#submit').removeAttr('disabled')
            }
          },
          error: function(error) {
            console.log("fails");
            console.log(JSON.stringify(error))
          }
        })
      })

      //validating the contact number


      //validating the retype email
      $('#reemail').keyup(function() {
        var userEmail = $('#email').val()
        var reuserEmail = $('#reemail').val()
        if (userEmail != reuserEmail) {
          $('#submit').attr('disabled', 'disabled')
          $('#reemailError').show()
        } else {
          $('#reemailError').hide()
          $('#submit').removeAttr('disabled')
        }
      })

      //validating password
      $('#password').keyup(function() {
        var password = this.value

        if (password.length < 8) {
          $('#submit').attr('disabled', 'disabled')
          $('#passwordError').show()
        } else {
          $('#passwordError').hide()
          $('#submit').removeAttr('disabled')
        }
      })

      //validating retype password
      $('#password_confirmation').keyup(function() {
        var password = $('#password').val()
        var repassword = $('#password_confirmation').val()
        if (password != repassword) {
          $('#submit').attr('disabled', 'disabled')
          $('#repasswordError').show()
        } else {
          $('#repasswordError').hide()
          $('#submit').removeAttr('disabled')
        }
      })

      //manually inserting the ID
      var id = parseInt($('#get_id').val()) + 1
      $('#user_id').val(id)

      //know if policy and terms is check
      $('#submit').attr('disabled', 'disabled')
      $('#terms').on('click', function() {
        if ($(this).is(':checked')) {
          $('#termsError').hide()
          $('#submit').removeAttr('disabled')
        } else {
          $('#termsError').show()
          $('#submit').attr('disabled', 'disabled')
        }
      })

    })

    //displaying signature image
    var loadFile = function(event) {

      var image_signature = document.getElementById('signature')
      // Check if any file is selected.
      if (image_signature.files.length > 0) {

        for (const i = 0; i <= image_signature.files.length - 1; i++) {

          const fsize = image_signature.files.item(i).size;
          const file = Math.round((fsize / 1024));
          // The size of the file.
          if (file >= 4096) {
            $('#signature').val('')
            $('#signatureError').show()
            $('#submit').attr('disabled', 'disabled')

          } else {
            $('#signatureError').hide()
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            $('#submit').removeAttr('disabled')
          }
        }
      }
    };

    //displaying ID image
    var loadFile_ID = function(event) {

      var image_ID = document.getElementById('ID')
      // Check if any file is selected.
      if (image_ID.files.length > 0) {

        for (const i = 0; i <= image_ID.files.length - 1; i++) {

          const fsize = image_ID.files.item(i).size;
          const file = Math.round((fsize / 1024));
          // The size of the file.
          if (file >= 4096) {
            $('#ID').val('')
            $('#IDError').show()
            $('#submit').attr('disabled', 'disabled')

          } else {
            $('#IDError').hide()
            var image = document.getElementById('output_Id');
            image.src = URL.createObjectURL(event.target.files[0]);
            $('#submit').removeAttr('disabled')
          }
        }
      }
    }

    //displaying birth cert image
    var loadFile_Birth_Cert = function(event) {

      var image_birth_cert = document.getElementById('birth_certificate')
      // Check if any file is selected.
      if (image_birth_cert.files.length > 0) {

        for (const i = 0; i <= image_birth_cert.files.length - 1; i++) {

          const fsize = image_birth_cert.files.item(i).size;
          const file = Math.round((fsize / 1024));
          // The size of the file.
          if (file >= 4096) {
            $('#birth_certificate').val('')
            $('#birthError').show()
            $('#submit').attr('disabled', 'disabled')

          } else {
            $('#birthError').hide()
            var image = document.getElementById('output_birth_cert');
            image.src = URL.createObjectURL(event.target.files[0]);
            $('#submit').removeAttr('disabled')
          }
        }
      }
    }
  </script>


</head>
<style>
  body {
    font-family: 'Poppins', 'san-serif';

    /*linear-gradient(to bottom right, #ffff4d,#fe783b);*/
    background-image: linear-gradient(to bottom right, #fe783b, yellow);


  }


  /*body:before{
    height: 100vh;
    content: "";
    background: url(img/image2.jpg);
    background-repeat: no-repeat; 
      background-attachment: fixed;
      background-size: cover;

    opacity: 0.6;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    position: absolute;
    z-index: -1;   
    }*/

  .center {
    margin-right: 100px;
    margin-left: 100px;
    text-align: center;
  }

  input {
    width: 300px;
    margin-left: 10px;
  }

  #youth_title {
    font-size: 30px;
  }

  .head-title {
    font-size: 20px;
  }

  form {
    margin-right: 100px;
    margin-left: 100px;
    margin-top: 20px;
  }

  .file_upload {
    color: white;
    border-radius: 5px;
    padding: 20px;
    cursor: pointer;
  }
</style>

<body>
  <div class="container-fluid pt-4">
    <section class="step-wizard">
      <ul class="step-wizard-list">
        <li class="step-wizard-item current-item" id="step1">
          <span class="progress-count">1</span>
          <span class="progress-label">Personal Info</span>
        </li>
        <li class="step-wizard-item" id="step2">
          <span class="progress-count">2</span>
          <span class="progress-label">Guardian Info</span>
        </li>
        <li class="step-wizard-item" id="step3">
          <span class="progress-count">3</span>
          <span class="progress-label">Refferal</span>
        </li>
        <li class="step-wizard-item" id="step4">
          <span class="progress-count">4</span>
          <span class="progress-label">Documents</span>
        </li>
        <li class="step-wizard-item" id="step5">
          <span class="progress-count">5</span>
          <span class="progress-label">Login Credentials</span>
        </li>
      </ul>
    </section>

    <x-jet-validation-errors class="mb-4" />
    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @foreach($depositor as $depositor_info)
      @endforeach
      <!--BODY-->
      <div class="bg-white rounded shadow mt-5 px-4 py-4 overflow-hidden">
        <p class="fw-bold text-uppercase" style="text-align: center; font-size:25px">Youth savers club application</p>
        <!--personal info-->
        <div class="PerInfo row">
          <div class="col-sm-12 mb-3">
            <h5 class="head-title">Personal information</h5>
            <hr class="mt-2">
          </div>
          <div class="col-md-4">
            <x-jet-input id="firstname" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" class="form-control mb-3" type="text" placeholder="First name*" />
          </div>
          <div class="col-md-4">
            <x-jet-input id="lastname" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" class="form-control mb-3" type="text" placeholder="Last name*" />

          </div>
          <div class="col-sm-3">
            <x-jet-input id="middlename" name="middlename" :value="old('middlename')" required autofocus autocomplete="middlename" class="form-control mb-3" type="text" placeholder="Middle name*" />

          </div>
          <div class="col-sm-1">

            <select name="suffix" id="suffix" class="form-control mb-3 ">
              <option value="">suffix</option>
              <option value="Sr" @if(old('suffix')=="Sr" ){{'selected'}} @endif>Sr</option>
              <option value="Jr" @if(old('suffix')=="Jr" ){{'selected'}} @endif>Jr</option>
              <option value="II" @if(old('suffix')=="II" ){{'selected'}} @endif>II</option>
              <option value="III" @if(old('suffix')=="III" ){{'selected'}} @endif>III</option>
              <option value="IV" @if(old('suffix')=="IV" ){{'selected'}} @endif>IV</option>
              <option value="V" @if(old('suffix')=="V" ){{'selected'}} @endif>V</option>
              <option value="VI" @if(old('suffix')=="VI" ){{'selected'}} @endif>VI</option>
              <option value="VII" @if(old('suffix')=="VII" ){{'selected'}} @endif>VII</option>
              <option value="VIII" @if(old('suffix')=="VIII" ){{'selected'}} @endif>VIII</option>
            </select>
          </div>

          <div class="col-md-4">
            <x-jet-input id="date_of_birth" name="date_of_birth" :value="old('date_of_birth')" required autofocus autocomplete="date_of_birth" class="form-control mb-2" type="text" placeholder="Birthdate*" onfocus="(this.type='date')" />
            <span style="color: red; font-size: 10px" id="age_error" class="hidden">Opps, You cannot proceed since age doesn't meet the requirement, please contact us!
            </span>
          </div>

          <div class="col-md-4">
            <select name="gender" id="gender" class="form-control mb-3" required>
              <option value="">Gender*</option>
              <option value="Male" @if(old('gender')=="Male" ){{'selected'}} @endif>Male</option>
              <option value="Female" @if(old('gender')=="Female" ){{'selected'}} @endif>Female</option>
            </select>
          </div>
          <div class="col-md-4">
            <x-jet-input id="home_address" name="home_address" :value="old('home_address')" required autofocus autocomplete="home_address" class="form-control mb-3" type="text" placeholder="Home address*" />
          </div>
          <div class="col-md-4">
            <h5 class="fs-13 ml-2">Contact No*</h5>
            <x-jet-input id="contact_no" name="contact_no" :value="old('contact_no')" required autofocus autocomplete="contact_no" class="form-control" onKeyPress="if(this.value.length==11) return false;" type="number" placeholder="Contact number*" />
            <span style="color: red; font-size: 10px" id="contact_noError" class="ml-2 hidden">Please input a valid Phone number
            </span>
          </div>
          <div class="col-md-4">
            <h5 class="fs-13 ml-2">Location*</h5>
            <select name="branch_id" id="branch_id" class="form-control mb-3" required>
              <option value="" disabled="true" selected="true">--Select Location--</option>
              <?php

              use Illuminate\Support\Facades\DB;

              $id = DB::table('branchs')->pluck('branch_id', 'branch_name');
              foreach ($id as $branch => $id) {
                echo "<option value=$id {{ old('branch_id')==$id? 'selected':''}}>$branch</option>";
              }
              ?>
              <!-- echo "ID: ", $id;
                    echo " Name: ", $branch,"<br>";} -->
            </select>
          </div>

          <div class="col-md-4">
            <h5 class="fs-13 ml-2">Branch* </h5>
            <select name="branch_under_id" id="branch_under_id" class="form-control mb-3 branch_name" required autofocus>
              <option value=""></option>
            </select>

          </div>

          <div class="col-md-4 mb-2">

            <button class="btn btn-success rounded shadow fs-8" id="nxtBtnPerInfo" style="font-family: 'Poppins', san-serif; font-weight:bold; color:white; width:50%">Next</button>
          </div>
        </div>



        <!--guardian info-->
        <div class="GuardInfo hidden">
          <div class="row">
            <div class="col-md-12 mb-3">
              <h5 class="fs-15 fc-black head-title">Guardian Information</h5>
              <hr class="mt-2">
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_firstname" name="guardian_firstname" :value="old('guardian_firstname')" required autofocus autocomplete="guardian_firstname" class="form-control mb-3" type="text" placeholder="First name*" />
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_lastname" name="guardian_lastname" :value="old('guardian_lastname')" required autofocus autocomplete="guardian_lastname" class="form-control mb-3" type="text" placeholder="Last name*" />
            </div>
            <div class="col-sm-3">
              <x-jet-input id="guardian_middlename" name="guardian_middlename" :value="old('guardian_middlename')" required autofocus autocomplete="guardian_middlename" class="form-control mb-3" type="text" placeholder="Middle name*" />
            </div>
            <div class="col-sm-1">
              <select name="guardian_suffix" id="guardian_suffix" class="form-control mb-3 ">
                <option value="">suffix</option>
                <option value="Sr">Sr</option>
                <option value="Jr">Jr</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
                <option value="VII">VII</option>
                <option value="VIII">VIII</option>
              </select>
            </div>

            <div class="col-md-4">
              <x-jet-input id="guardian_date_of_birth" name="guardian_date_of_birth" :value="old('guardian_date_of_birth')" required autofocus autocomplete="guardian_date_of_birth" class="form-control mb-3" type="text" placeholder="Birthdate*" onfocus="(this.type='date')" />
            </div>
            <div class="col-md-4">
              <select name="guardian_gender" id="guardian_gender" class="form-control mb-3" required>
                <option value="">Gender*</option>
                <option value="Male" @if(old('guardian_gender')=="Male" ){{'selected'}} @endif>Male</option>
                <option value="Female" @if(old('guardian_gender')=="Female" ){{'selected'}} @endif>Female</option>
              </select>
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_home_address" name="guardian_home_address" :value="old('guardian_home_address')" required autofocus autocomplete="guardian_home_address" class="form-control mb-3" type="text" placeholder="Home Address*" />
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_present_address" name="guardian_present_address" :value="old('guardian_present_address')" required autofocus autocomplete="guardian_present_address" class="form-control mb-3" type="text" placeholder="Present address*" />
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_contact_no" name="guardian_contact_no" :value="old('guardian_contact_no')" required autofocus autocomplete="guardian_contact_no" class="form-control mb-3" onKeyPress="if(this.value.length==11) return false;" type="number" placeholder="Contact number*" />
            </div>
            <div class="col-md-4">
              <x-jet-input id="guardian_relationship_to_depositor" name="guardian_relationship_to_depositor" :value="old('guardian_relationship_to_depositor')" required autofocus autocomplete="guardian_relationship_to_depositor" class="form-control mb-3" type="text" placeholder="Relation To The Depositor*" />
            </div>
            <div class="col-sm-4">
              <select name="guardian_civil_status" id="guardian_civil_status" class="form-control mb-3 ">
                <option value="">Civil Status*</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Separated">Separated</option>
                <option value="Widowed">Widowed</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select name="guardian_oic_member" id="guardian_oic_member" class="form-control mb-3 ">
                <option value="">OIC member?*</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>


              </select>
            </div>
            <div class="col-sm-4 mb-2">
              <x-jet-input id="guardian_email_add" name="guardian_email_add" :value="old('guardian_email_add')" autofocus autocomplete="guardian_email_add" class="form-control mb-3" type="text" placeholder="Email Address(if applicable)" />
            </div>
            <div class="col-md-1">
              <x-jet-button id="guardBckBtn">Back</x-jet-button>
            </div>
            <div class="col-md-1">
              <x-jet-button id="guardNxtBtn">Next</x-jet-button>
            </div>
          </div>

        </div>

        <!--referral-->
        <div class="ReferInfo hidden">
          <div class="row">
            <div class="col-sm-12 mb-3">
              <h5 class="fs-15 fc-black head-title">Referral (If applicable)</h5>
              <hr class="mt-2">
            </div>
            <div class="col-sm-4">
              <x-jet-input id="referral_fname" name="referral_fname" :value="old('referral_fname')" autofocus autocomplete="referral_fname" class="form-control mb-3" type="text" placeholder="Firstname*" />
            </div>
            <div class="col-sm-4">
              <x-jet-input id="referral_lname" name="referral_lname" :value="old('referral_lname')" autofocus autocomplete="referral_lname" class="form-control mb-3" type="text" placeholder="Lastname*" />
            </div>
            <div class="col-sm-4">
              <x-jet-input id="referral_mname" name="referral_mname" :value="old('referral_mname')" autofocus autocomplete="referral_mname" class="form-control mb-3" type="text" placeholder="Middlename*" />
            </div>

            <div class="col-md-4">
              <h5 class="fs-13 ml-2">Branch*</h5>
              <select name="branch_idR" id="branch_idR" class="form-control mb-3">
                <option value="" disabled="true" selected="true">--Select Branch--</option>
                <?php
                $id1 = DB::table('branchs')->pluck('branch_id', 'branch_name');
                foreach ($id1 as $branch => $id1) {
                  echo "<option value=$id {{ old('branch_id')==$id1? 'selected':''}}>$branch</option>";
                }
                ?>
                <!-- echo "ID: ", $id;
                    echo " Name: ", $branch,"<br>";} -->
              </select>
            </div>

            <div class="col-md-4">
              <h5 class="fs-13 ml-2">Branch Under* </h5>
              <select name="branch_under_idR" id="branch_under_idR" class="form-control mb-3 branch_nameR" autofocus>
                <option value=""></option>
              </select>

            </div>
            <div class="col-md-4 mb-2"></div>
            <div class="col-md-1">
              <x-jet-button id="referBckBtn">Back</x-jet-button>
            </div>
            <div class="col-md-1">
              <x-jet-button id="referSkipBtn">Skip</x-jet-button>
            </div>
            <div class="col-md-1">
              <x-jet-button id="referNxtBtn">Next</x-jet-button>
            </div>
          </div>

        </div>


        <!--upload documents-->
        <div class="uploadDocu hidden">
          <div class="row">
            <div class="col-sm-12 mb-3 mt-3">
              <h5 class="fs-15 fc-black head-title">Upload Documents</h5>
              <hr class="mt-2">
            </div>
            <div class="col-md-4 mb-3">
              <h5 class="fs-13 ml-2">Signature* </h5>
              <p><img src="" id="output" width="500" alt=""></p>
              <x-jet-input id="signature" type="file" name="signature" :value="old('signature')" onchange="loadFile(event)" required accept=".png, .jpg, .jpeg" class="form-control mt-2 mb-3 file_upload" />
              <!-- <x-jet-label for="signature" id="file_upload">Upload Signature*</x-jet-label>-->
              <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
              <span style="color: red; font-size: 10px" id="signatureError" class="ml-2 hidden">Opps, image exceeds 4mb
              </span>


            </div>
            <div class="col-md-4 mb-3">
              <h5 class="fs-13 ml-2">2*2 picture * </h5>
              <p><img src="" id="output_Id" width="500" alt=""></p>
              <x-jet-input id="ID" type="file" name="Identification" accept=".png, .jpg, .jpeg" required onchange="loadFile_ID(event)" class="form-control mt-2 mb-3 file_upload" />
              <!-- <x-jet-label for="ID" id="file_upload" >Upload Valid ID*</x-jet-label>-->
              <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
              <span style="color: red; font-size: 10px" id="IDError" class="ml-2 hidden">Opps, image exceeds 4mb
              </span>
            </div>
            <div class="col-md-4 mb-3">
              <h5 class="fs-13 ml-2">Birth Certificate* </h5>
              <p><img src="" id="output_birth_cert" width="500" alt=""></p>
              <x-jet-input id="birth_certificate" type="file" name="birth_certificate" :value="old('birth_certificate')" onchange="loadFile_Birth_Cert(event)" accept=".png, .jpg, .jpeg" required class="form-control mt-2 mb-3 file_upload" />
              <!--  <x-jet-label for="birth_certificate" id="file_upload" >Upload Birth Certificate*</x-jet-label>-->
              <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
              <span style="color: red; font-size: 10px" id="birthError" class="ml-2 hidden">Opps, image exceeds 4mb
              </span>
            </div>
            <div class="col-md-1">
              <x-jet-button id="uploadBackBtn">Back</x-jet-button>
            </div>

            <div class="col-md-1 mb-2">
              <x-jet-button id="uploadNxtBtn">Next</x-jet-button>
            </div>
          </div>

        </div>

        <!--login credentials-->
        <div class="loginInfo hidden">
          <div class="row">
            <div class="col-sm-12 mb-3 mt-2">
              <h5 class="fs-15 fc-black head-title">Login credentials</h5>
              <hr class="mt-2">
            </div>
            <div class="col-md-4 mb-3">
              <x-jet-input id="user_id" type="hidden" name="user_id" :value="old('user_id')" required class="form-control" placeholder="Customer Id*" />
              <?php
              $id = DB::table('users')->latest('created_at')->pluck('id')->first();
              if ($id != null) {

                echo "<input type='hidden' id='get_id' value='$id'/>";
              } else {
                echo "<input type='hidden' id='get_id' value='0'/>";
              }
              ?>

              <span style="color: red; font-size: 10px; " id="CustomerIdError" class="ml-2 hidden">Customer ID already used!
              </span>
            </div>
            <div class="col-md-4 mb-3">
              <x-jet-input id="reuser_id" type="hidden" name="reuser_id" :value="old('reuser_id')" required class="form-control" placeholder="Retype Customer Id*" />
              <span style="color: red; font-size: 10px" id="reCustomerIdError" class="ml-2 hidden">Whoops, these don't match!
              </span>
            </div>

            <div class="col-md-4">
              <!--SPACE-->
            </div>

            <div class="col-md-4 mb-3">
              <x-jet-input id="email" type="email" name="email" :value="old('email')" required class="form-control signup-input2" placeholder="Email Address*" />
              <span style="color: red; font-size: 10px" id="emailError" class="ml-2 hidden">Email address already used!
              </span>
            </div>
            <div class="col-md-4 mb-3">
              <x-jet-input id="reemail" type="reemail" name="reemail" :value="old('email')" required class="form-control signup-input2" placeholder="Retype Email Address" />
              <span style="color: red; font-size: 10px" id="reemailError" class="ml-2 hidden">Whoops, these don't match!
              </span>
            </div>
            <div class="col-md-4">
              <!--SPACE-->
            </div>
            <div class="col-md-4 mb-3">
              <x-jet-input id="password" name="password" autocomplete="new-password" type="password" required class="form-control " placeholder="Password" />
              <span style="color: red; font-size: 10px" id="passwordError" class="ml-2 hidden">Password should be atleast 8 characters
              </span>
            </div>
            <div class="col-md-4 mb-3">
              <x-jet-input id="password_confirmation" name="password_confirmation" autocomplete="new-password" type="password" required class="form-control " placeholder="Retype Password" />
              <span style="color: red; font-size: 10px" id="repasswordError" class="ml-2 hidden">Whoops, these don't match
              </span>
            </div>





            <div class="col-md-4">
              <!--SPACE-->
            </div>
            <div class="col-md-4">
              <input type="hidden" name="scope" id="scope" value="depositor">
              <input type="hidden" name="user_status_id" id="user_status_id" value="1">
              <input type="hidden" name="status_id" value="1" id="status_id" />
              <input type="hidden" value="1" name="level_id" id="level_id" />
              @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
              <div class="mt-4 mb-3">
                <x-jet-label for="terms">
                  <div class="flex items-center">
                    <x-jet-checkbox name="terms" id="terms" required autofocus />
                    <div class="row">


                      <div class="ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<button id="termsPolicy" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</button>',
                        'privacy_policy' => '<button id="Privacy_popup" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</button>',
                        ]) !!}
                      </div>
                      <span style="color: red; font-size: 10px" id="termsError" class="ml-2 hidden">Please check the terms and policy
                      </span>
                    </div>
                  </div>
                </x-jet-label>
              </div>

              @endif
              <x-jet-button id="loginBackBtn" class="mb-2">Back</x-jet-button>
              <x-jet-button id="submit" type="submit" class="mb-5">{{ __('Register') }}</x-jet-button>

            </div>
          </div>
        </div>
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>
      </div>
    </form>
    <div class="mt-4 pt-4">
      @include('officer.admin.includes.footer')
    </div>

  </div>

  <!--bootstrap bundle-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!--Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {

    })
  </script>



</body>

</html>


<!--none-->
<x-guest-layout>

  <x-jet-authentication-card>

    <x-slot name="logo">
      <x-jet-authentication-card-logo />
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
      @csrf


      <div>
        <x-jet-label for="firstname" value="{{ __('FirstName') }}" />
        <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
      </div>

      <div class="mt-4">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
      </div>

      <div class="mt-4">
        <x-jet-label for="password" value="{{ __('Password') }}" />
        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
      </div>

      <div class="mt-4">
        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
      </div>

      @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
      <div class="mt-4">
        <x-jet-label for="terms">
          <div class="flex items-center">
            <x-jet-checkbox name="terms" id="terms" />

            <div class="ml-2">
              {!! __('I agree to the :terms_of_service and :privacy_policy', [
              'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
              'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
              ]) !!}
            </div>
          </div>
        </x-jet-label>
      </div>
      @endif

      <div class="">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>

        <x-jet-button class="ml-4">
          {{ __('Register') }}
        </x-jet-button>
      </div>
    </form>
  </x-jet-authentication-card>
</x-guest-layout>