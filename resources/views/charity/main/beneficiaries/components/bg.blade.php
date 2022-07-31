<!-- Problem -->
<h4 class="my-3 mt-5" style="color: #62896d">Problem Presented</h4>
<textarea class="form-control" rows="5" name="problem_presented">Clark is incoming kinder student but their family cannot afford to send her to school due to lack of money. The money that mother earns in selling for 8 hours a day which is only 300 pesos is not enough to buy their daily meals and medication for their grandmother. </textarea>
@error('problem_presented')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Problem-->

<h4 class="my-3 mt-4" style="color: #62896d">Background Information</h4>

<h6>A. About the Client</h6>
<textarea class="form-control" rows="5" name="about_client">The family lives in the slum area of Barangay 133. Every morning, her mother goes to wet market to sell salt. While her mother is away, Clark is under the care of her grandmother. When the grandmother is feeling okay, she and Althea creates basket crafts and sells them for P50.</textarea>
@error('about_client')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">B. About the Family</h6>
<textarea class="form-control" rows="5" name="about_family">A typical low-income family in the United States is a mother and one or two children. An average day for such a family starts early, with the mother feeding the children before they start school. The children usually do their homework, sometimes even while going on a field trip to see another school. After school they play sports and engage in hobbies before enjoying a meal with their families. Following this meal comes a long day of relaxation or watching TV as everyone enjoys downtime together.</textarea>
@error('about_family')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">C. About the Community</h6>
<textarea class="form-control" rows="5" name="about_community">This project is based on real experiences of the poor Filipino community living in a community where poverty is rampant.We have been conducting more than 30 interviews and observation with local families who are struggling to make ends meet.</textarea>
@error('about_community')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror


<!--Assessment / Recommendation -->
<h4 class="my-3 mt-4" style="color: #62896d">Assessment / Recommendation</h4>
<textarea class="form-control" rows="5" name="assessment">Charity work is a joint mission for us. We have demonstrated our tacit commitment and pride during our as well as the beneficiary’s regular assessment visits and discussions at the field level. We had also recommended a series of strategies to help the child combat malnourishment and poverty. </textarea>
@error('assessment')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Assessment / Recommendation-->