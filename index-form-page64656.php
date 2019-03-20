<div class="row">
    <div class="container">

        <div class="main">
            <h3>Registration Form</h3>
            <div class="tools">
            </div>
                <form method="post">
                    <div class="col-md-12">
                        <label> Name *</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Mobile">Mobile *</label>
                        <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Mobile" required>                 
                    </div>
                    <div class="col-md-6">
                        <label> Email *</label> 
                        <input type="text" class="form-control" name="email" id="email" placeholder="test@example.com" required>                
                    </div>

                    <div class="col-md-6">
                        <label for="Birth Year">Birth Year *</label>
                        <input type="number" name="birth_year" class="form-control" id="birth_year" placeholder="Ex: 1966*" required>
                    </div>
                    <div class="col-md-6">
                        <label class="selectlabel" for="gendar">Gender: * </label>
                        <select class="form-control" id="gendar" name="gender" required>
                            <option selected value="">Choose here</option>
                            <?php
                                foreach ($gendars as $gendar) {
                                    ?>
                            <option value="<?php echo $gendar['id']; ?>"><?php echo $gendar['name']; ?></option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="selectlabel" for="idtype">ID Type:</label>
                        <select class="form-control" id="id_type" name="id_type">
                            <option selected value="">Choose here</option>
                            <?php
                                foreach ($IDTypes as $IdTypes) {
                                    ?>
                            <option value="<?php echo $IdTypes['id']; ?>"><?php echo $IdTypes['name']; ?></option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label>ID Number</label>
                        <input type="text" name="id_number" class="form-control" placeholder="ID Number" id="IDNumber">
                    </div>



                    
                    <div class="col-md-6">
                        <label>Are you a foreign national?</label>
                        
                        <label class="radio-inline">
                          <input type="radio" name="isForeign" id="isForeign1" value="Yes"> Yes
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="isForeign" id="isForeign2" value="No" required> No
                        </label>
                    </div>



                    <div class="checkbox col-md-12">
                        <label>
                        <input type="checkbox" id="inputTermsConditions" name="tc" required> I have read and I agree to the <a href="" data-toggle="modal" data-target="#myModal" style="color:green; text-decoration:none;">Aarong 40th Festival Ticketing Terms and Condition * </a>.
                        </label>
                    </div>

                    <?php
                    /* * * set a form token ** */
                    $registration_form_token = md5(uniqid('auth', true));
                    /* * * set the session form token ** */
                    $_SESSION['registration_form_token'] = $registration_form_token;
                    ?>
                    <input type="hidden" name="registration_form_token" value="<?php echo $registration_form_token; ?>">


                    <div class="col-md-12">
                        <button type="submit" name="save" value="Save" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="helpline col-md-offset-4 col-md-8">
                        Helpline : +88 01844 050 730 (10 AM - 08 PM)
                    </div>
                </form>
        </div>
    </div>
</div>