<div id="form-error-box" class="column is-offset-3 is-6 notification is-danger" style="display:none">
    <ul id="form-error-list">
    </ul>
</div>
<form action="{{ route('resident.store') }}" method="POST" id="residentCreate">
    <div class="columns">
        <div class="column is-offset-1 is-half">
            <div class="columns">
                {{ csrf_field() }}
                <div class="field is-horizontal">
                    <div class="column">
                        <label class="label">First Name <sup>*</sup></label>
                        <p class="control">
                            <input class="input" type="text" name="first_name" required autofocus>
                        </p>
                    </div>
                    <div class="column">
                        <label class="label">Last Name <sup>*</sup></label>
                        <p class="control">
                            <input class="input" type="text" name="last_name">
                        </p>
                    </div>
                    <div class="column is-2">
                        <label class="label has-text-centered">MI <sup>*</sup></label>
                        <p class="control">
                            <input class="input" type="text" name="middle_initial">
                        </p>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-4">
                    <label class="label">Date of birth <sup>*</sup></label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="dob" id="dob" placeholder="YYYY-MM-DD">
                    </p>
                </div>
                <div class="column is-3">
                    <label class="label">Age <sup>*</sup></label>
                    <p class="control">
                        <input class="input" type="number" name="age" id="age">
                    </p>
                </div>
                <div class="column is-6">
                    <label class="label">Drug of Choice</label>
                    <p class="control">
                        <span class="select">
                            <select name="drug" id="drug">
                                <option value="">Select substance</option>
                                <option value="Cocaine">Cocaine</option>
                                <option value="Alcohol">Alcohol</option>
                                <option value="Cannabis">Cannabis</option>
                                <option value="Amphetamines">Amphetamines</option>
                                <option value="Barbiturates">Barbiturates</option>
                                <option value="Poly Substance">Poly Substance</option>
                                <option value="Opiates">Opiates</option>
                                <option value="Morphine">Morphine</option>
                                <option value="LSD">LSD</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-offset-1 is-8">
                    <label class="label has-text-centered">Email </label>
                    <p class="control">
                        <input class="input" type="text" name="email">
                    </p>
                </div>
            </div>
            <hr>
            <div class="column is-offset-1">
                <div class="columns">
                    <div class="column is-one-third">
                        <label class="label">Sex <sup>*</sup></label>
                        <label class="radio">
                            <input type="radio" class="gender" name="sex" value="M">Male
                        </label>
                        <label class="radio">
                            <input type="radio" class="gender" name="sex" value="F">Female
                        </label>
                    </div>
                    <div class="column is-half">
                        <label class="label">Race <sup>*</sup></label>
                        <p class="control">
                            <span class="select">
                                <select class="race" name="race">
                                    <option value="">Select Race</option>
                                    <option value="American Indian or Alaskan Native">American Indian or Alaskan Native</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Black or African American">Black or African American</option>
                                    <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
                                    <option value="White">White</option>
                                    <option value="Hispanic or Latino">Hispanic or Latino</option>
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <label class="label">DOC Number <sup>*</sup></label>
                    <p class="control">
                        <input class="input" type="text" name="document_number">
                    </p>
                </div>
                <div class="column">
                    <label class="label">SC#<sup>*</sup></label>
                    <p class="control">
                        <input class="input" type="text" name="service_center_number">
                    </p>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <label class="label">Date of admission <sup>*</sup></label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="date_of_admission" id="date_of_admission">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Projected Discharge <sup>*</sup></label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="projected_date_of_discharge"
                               id="projected_date_of_discharge">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Actual Date of Discharge</label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="actual_date_of_discharge" id="actual_date_of_discharge">
                    </p>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <label class="label">Status <sup>*</sup></label>
                    <p class="control">
                        <span class="select">
                            <select name="status" id="status">
                                <option value="">Status</option>
                                <option value="DOP">DOP</option>
                                <option value="Prob">Prob</option>
                                <option value="PDO">PDO</option>
                                <option value="CC">CC</option>
                                <option value="County">County</option>
                                <option value="Federal">Federal</option>
                            </select>
                        </span>
                    </p>
                </div>
                <div class="column">
                    <label class="label">Status At Discharge</label>
                    <p class="control">
                        <span class="select">
                            <select name="status_at_discharge" id="status-at-discharge">
                                <option value="">Select Status at Discharge</option>
                                <option value="Successful">Successful</option>
                                <option value="Administrative">Administrative</option>
                                <option value="Unsuccessful - Abscond">Unsuccessful - Abscond</option>
                                <option value="Unsuccessful - Disciplinary">Unsuccessful - Disciplinary</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <label class="label">Counselor <sup>*</sup></label>
                    <p class="control">
                        <input class="input" type="text" name="counselor">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Program Level <sup>*</sup></label>
                    <p class="control">
                        <span class="select">
                            <select name="program_level" id="program-level">
                                <option value="">Select Program level</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <label class="label">Employer</label>
                    <p class="control">
                        <input class="input" type="text" name="employer" id="employer">
                    </p>
                </div>
                <div class="column is-half">
                    <label class="label">Employment Date</label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="employment_date" id="employment_date">
                    </p>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column">
                    <label class="label">Payment Method <sup>*</sup></label>
                    <p class="control">
                        <span class="select">
                            <select id="payment-method" name="payment_method">
                                <option value="">Select payment method</option>
                                <option value="Nonsecure">Nonsecure</option>
                                <option value="DOC Funded">DOC Funded</option>
                                <option value="DOC Co-pay">DOC Co-pay</option>
                            </select>
                        </span>
                    </p>
                </div>
                <div class="column">
                    <label class="label">Referral Source <sup>*</sup></label>
                    <p class="control">
                        <span class="select">
                            <select id="referral-source" name="referral_source">
                                <option value="">Select referral source</option>
                                <option value="DOC">DOC</option>
                                <option value="WCFDI">WCFDI</option>
                            </select>
                        </span>
                    </p>
                </div>
            </div>
            <div class="column">
                <button class="button is-primary" type="submit" id="residentSubmit">Submit</button>
            </div>
        </div>
    </div>
</form>
