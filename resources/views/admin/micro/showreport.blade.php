<?php 
$product = \App\Product::find($report_id); 

?>
@extends('admin.layout.main')

@section('content')
        <div class="container-fluid">
            <div class="card" style="padding: 15px">
            <form action="{{url('admin/micro/report/update',['id' => $report_id])}}" method="POST">
                    {{ csrf_field() }} 
                <div class="text-center"> 
                <img src="{{asset('admin/img/logo.jpg')}}" class="" width="9%">
                <h5 class="font" style="font-size:16px"> Microbiology Department Centre for Plant Medicine Research </h5>
                <p class="card-subtitle">Microbial Analysis Report on Herbal Product</p>
               </div>
            
                    
               
                    @include('admin.micro.temp.productformat') 
                    @include('admin.micro.temp.mlreportformat')                  

                    @include('admin.micro.temp.mereportform')
                    @include('admin.micro.temp.mereportformat')


                   <div class="row">
                     @if ( $product->micro_hod_evaluation > 0)
                     <div class="col-sm-8">
                         <h4 class="font" style="font-size:15px; margin:20px; margin-top:15px"> <strong>HOD REMARKS: </strong></h4>
                         <div class="alert alert-info" role="alert">
                             {{$product->micro_hod_remarks}}
                           </div>
                     </div>
                     @endif
                    <div class="col-sm-3" style="margin-top:30px">
                        <div class="form-group">
                            <label for="exampleInputEmail3"> <strong><span style="color: red">Report Evaluation</span></strong>  </label>
                            <select name="micro_grade" required class="form-control" id="exampleSelectGender">
                            <option value="{{$product->micro_grade}}">{!! $product->micro_grade_report !!}</option>
                                <option value="1">Failed</option>
                                <option value="2">Passed</option>
                            </select>                                
                            </div>
                    </div>
                </div>
                    <div class="row invoice-info" style="margin: 15px; margin-top:60px">
                        <?php
                        $micro_analysed_by = ($product? $product->micro_analysed_by:'');
                        $user_type         = (\App\Admin::find($micro_analysed_by)? \App\Admin::find($micro_analysed_by)->user_type_id:'');
                      ?>
                        <div class="col-sm-4 invoice-col">
                            <p>Analyzed By</p><br>
                            @if ($product->micro_hod_evaluation > null)
                            <img src="{{asset(\App\Admin::find($micro_analysed_by)? \App\Admin::find($micro_analysed_by)->sign_url:'')}}" class="" width="42%"><br>
                            @endif
                            -----------------------------<br>
                          
                            <span>{{ucfirst(\App\Admin::find($micro_analysed_by)? \App\Admin::find($micro_analysed_by)->full_name:'')}}</span>
                            <p>{{ucfirst(\App\UserType::find($user_type )? \App\UserType::find($user_type )->name:'')}}</p>

                        </div> 
                        <div class="col-sm-4 invoice-col">
                             
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <?php
                            $micro_finalapproved_by = ($product? $product->micro_finalapproved_by:'');
                            $hod_user_type = (\App\Admin::find($micro_finalapproved_by)? \App\Admin::find($micro_finalapproved_by)->user_type_id:'');
    
                            ?>
                            <p>Approved by</p><br>
                            @if ($product->micro_finalapproved_by !== Null)
                            <img src="{{asset(\App\Admin::find($micro_finalapproved_by)? \App\Admin::find($micro_finalapproved_by)->sign_url:'')}}" class="" width="42%"><br>
                            @endif
    
                            ------------------------------<br> 
    
                            <span>{{ucfirst(\App\Admin::find($micro_finalapproved_by)? \App\Admin::find($micro_finalapproved_by)->full_name:'')}}</span>
                            <p>{{ucfirst(\App\Admin::find($micro_finalapproved_by)? \App\Admin::find($micro_finalapproved_by)->position:'')}}</p>
             
                        </div>

                    </div>
    
               </div>

            <div class="row">
                <div class="col-9">
                    <div class="row">
                   
                        <div class="col-sm-3">
                            @if ( $product->micro_hod_evaluation ===Null ||  $product->micro_hod_evaluation ===1 )
                            <button  type="submit" class="btn btn-success pull-right pharmsubmitreport1" id="pharm_submit_report" >
                            <i class="fa fa-credit-card "></i> 
                            Save Report
                            </button>
                            <button style="display: none" onclick="return confirm('NB: report will be submitted to the head of department. Click Ok to confirm report submission')" type="submit" class="btn btn-info pull-right pharmsubmitreport2" id="pharm_submit_report" >
                                <i class="fa fa-credit-card " ></i> 
                                Submit Report
                            </button>
                            @endif
                            @if ( $product->micro_hod_evaluation ==2)
                            <button type="button" onclick="myFunction()" class="btn btn-primary pull-right" id="pharm_complete_report" style="margin-right: 5px;">
                            <i class="fa fa-view"></i> Print Report</button>
                            @endif
                        </div>
                        <div class="col-sm-9">
                            @if ( $product->micro_hod_evaluation ===Null ||  $product->micro_hod_evaluation ===1 )
                            <div class="form-check mx-sm-2">
                                <label class="custom-control custom-checkbox">
                                    <input id="pharmsubmitreport" type="checkbox" name="complete_report" value="1" class="custom-control-input">
                                    <span class="custom-control-label">&nbsp;Check to complete report </span>
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-3">
                    @if ( $product->micro_hod_evaluation ===0)
                    <button type="button" class="btn btn-outline-danger"><i class="ik ik-x"></i>Approval Pending </button>
                    @endif
                    @if ( $product->micro_hod_evaluation ===1)
                    <button type="button" class="btn btn-outline-danger"><i class="ik ik-x"></i> Report Withheld</button>
                    @endif
                    @if ( $product->micro_hod_evaluation ===2)
                    <button type="button" class="btn btn-outline-success"><i class="ik ik-check"></i>Repport Approved </button>        
                   @endif
                </div>
            </div>
        </form>
        </div>
        
@endsection

@section('bottom-scripts')
<script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>   
<script src="{{asset('js/microbialcomments.js')}}"></script>

{{-- <script>
function myFunction() {
  var url = $('input[id="report_url"]').attr("value");
  var r = confirm("Be aware of the following before you complete report : 1.Completed Reports can not be edited after submision, system require you to see HoD for unavoidable complains or changes.  Thank you");
  if (r == true) {
  var  myWindow = window.open(url, "_blank", "width=500, height=500");
  } else {
   
  }
  document.getElementById("demo").innerHTML = txt;
}
</script> --}}

@endsection