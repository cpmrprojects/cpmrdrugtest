@extends('admin.layout.main')

@section('content')
@php
    $product = \App\Product::find($report_id);
    $hod_anex = App\Admin::where('id',Auth::guard('admin')->id())->where('dept_office_id',1)->first()
@endphp

<div class="container-fluid">
<div class="row">
    <div class="col-md-3">
        @include('admin.pharm.temp.hodtaskboard2')

    </div>

    <div class="col-md-9">
    <div class="card" style="padding: 3px">
           <div class="text-center"> 
             <img src="{{asset('admin/img/logo.jpg')}}" class="" width="9%">
             <h4 class="font" style="font-size:18px"> Centre for Plant Medicine Research </h4>
             <p class="card-subtitle">Pharmacology & Toxicology Department</p>
            </div>
            <form action="{{url('admin/pharm/hod_office/editreport',['id' => $pharmreports->id])}}" method="post">
              {{ csrf_field() }} 
                  @include('admin.pharm.temp.productformat') 
                  @if ($pharmreports->pharm_testconducted ==1  || $pharmreports->pharm_testconducted ==3)

                  <div class="row" >
                      <div class="col-sm-8">
                          <div class="card">
                              @include('admin.pharm.temp.finalreportform')
      
                          <div class="" style="padding: 1%">
                          <h4 class="font" style="font-size:18px; margin:10px; margin-top:1px"><strong> REMARKS: </strong></h4>
                          <p style="font-size: 16px">
                            <textarea id="summernote" class="form-control" name="pharm_acute_comment"  rows="6"> {{$pharmreports->pharm_acute_comment}} </textarea>
                          </p>       
                          </div>  
                          </div>
                      </div>
                      <div class="col-sm-4">
                              @include('admin.pharm.temp.acuteanimalexpreport') 
                      </div>
  
                  </div>
                  @endif
  
              {{-- This section is for Dermal test --}}
              @if ($pharmreports->pharm_testconducted ==2 || $pharmreports->pharm_testconducted ==3)
                      <div class="card">
                          <div class="row">
                              <div class="col-sm-7">
                                  {{-- <p style="font-size:16px; margin:4px; "></p> --}}
                                  <textarea id="summernote" name="pharm_standard" style="font-size: 16px;  text-align: justify ;" class="form-control" rows="9"> {{$pharmreports->pharm_standard}} </textarea>  
   
                                  <h4 class="font" style="font-size:18px; margin:10px; margin-top:15px"><strong> RESULTS: </strong></h4>
                                  <p >
                                      <textarea id="summernote0" name="pharm_result" style="font-size: 16px; text-align: justify ;" class="form-control" rows="5"> {{$pharmreports->pharm_result}} </textarea>  
                                  </p> 
                                  
                                  <h4 class="font" style="font-size:18px; margin:20px; margin-top:15px"> <strong>REMARKS: </strong></h4>
                          
                                  <p >
                                      <textarea id="summernote1" name="pharm_dermal_comment" id=""  style="font-size: 16px" class="form-control" rows="3"> {{$pharmreports->pharm_dermal_comment}} </textarea>
                                      
                                  </p>
                              </div>
                              <div class="col-sm-5">
                                  <div class="card-body">
                                      @include('admin.pharm.temp.dermalanimalexpreport') 
                                  </div>
                              </div>    
                          </div>  
                      </div>
               @endif
  
                  <div class="card">
              <div class="row"  style="margin:10px; margin-top:1px">
                  <div class="col-sm-8">
                      <div class="form-group">
                          <h4 class="font" style="font-size:18px; margin:10px; margin-top:5px"><strong> Final Remarks: </strong></h4>
  
                      <textarea required name="pharm_hod_remarks" class="form-control" id="exampleTextarea1" rows="4">{{$pharmreports->pharm_hod_remarks}}</textarea>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <h4 class="font" style="font-size:18px; margin:10px; margin-top:5px"><strong> Report Grade</strong></h4>
                      <p>{!! \App\Product::find($pharmreports->id)->pharm_grade_report !!} </p>
                          <select name="pharm_grade" required class="form-control" >
                          <option value="{{\App\Product::find($pharmreports->id)->pharm_grade}}">{!! \App\Product::find($pharmreports->id)->pharm_grade_report !!}</option>
                              <option value="1">Failed</option>
                              <option value="2">Passed</option>
                          </select> 
                      <br>
                                  
                  </div>
              </div>
                 @if ($pharmreports->pharm_hod_evaluation == 2 )
                 <div class="col-sm-3" style="margin-bottom:2%">
                  <button type="submit" class="btn btn-danger pull-right"> <i class="fa fa-credit-card"></i>Save report</button>
              </div>
  
                 @endif
                  
                  </div>
  
                  @include('admin.pharm.temp.signaturetemp') 

       </form>
  
  
  
  
          <div class="col-12">
            
              <div class="row" style="margin-top: 110px">
                  <div class="col-md-4">
                      @if ((\App\Product::find($report_id)->pharm_hod_evaluation ===2 && \App\Product::find($report_id)->pharm_process_status ===6) || \App\Product::find($report_id)->pharm_process_status ===7 ) 
                      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModalCenter"> <i class="ik ik-clipboard"></i> Evaluate Report</button>
                      @endif
                  </div>
                  <div class="col-md-8">
                      @if (\App\Product::find($report_id)->pharm_process_status ===7) 
                      <div class="alert alert-danger" role="alert">
                          Report of {{\App\Product::find($report_id)->productType->code}}|{{\App\Product::find($report_id)->id}}|{{\App\Product::find($report_id)->productType->created_at->format('y')}}  has been rejected.
                      </div>       
                     @endif
                  </div>
                    <div class="col-md-7" style="margin-right: 1%">
                        
                    
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document"> 
                          
                                 <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">Please Sign to evaluate report</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form  id="pharmhodfinalapproveform" sign-user-url="{{route('admin.pharm.hod_office.finalapproval.checkhodsign')}}" action="{{route('admin.pharm.hod_office.finalapproval.evaluatereport',['id' => $report_id])}}" class="" method="POST">
                                            {{ csrf_field() }}
                                        <input id ="_token" name="_token" value="{{ csrf_token() }}" type="hidden">
        
                                        <div class="input-group input-group-default col-md-6">
                                            <select class="form-control" name="evaluate">
                                                <option value="2">Approve Report</option>
                                                <option value="1">Reject Report</option>
                                            </select>
                                            </div>
                                            <div id="error-div" style="margin: 5px; color:red;"></div>
                                            <input name="adminid" id="adminid"  type="hidden" >
                    
                                            <div class="input-group input-group-default">
                                                @error('email')
                                                <small style="margin-left:120px;margin-top:-10; margin-bottom:5px" class="form-text text-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </small>
                                                @enderror
                                                <span class="input-group-prepend"><label class="input-group-text"><i class="ik ik-shield"></i></label></span>
                                                <input required id="useremail" type="email" class="form-control" name="email" placeholder="Enter your email">
                                            </div>
                    
                                            <div class="input-group input-group-default">
                                                @error('pin')
                                                <small style="margin-left:120px;margin-top:-10; margin-bottom:5px" class="form-text text-danger" role="alert">
                                                    <strong>{{$pin}}</strong>
                                                </small>
                                                @enderror
                                                <span class="input-group-prepend"><label class="input-group-text"><i class="ik ik-shield"></i></label></span>
                                                <input required id="userpin" type="password" class="form-control" name="pin" placeholder="Sign with PIN">
                                            </div>                         
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Sign Report</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                      </div>
                  <div class="col-md-4">  
                      @if (\App\Product::find($report_id)->pharm_hod_evaluation ===2 && \App\Product::find($report_id)->pharm_process_status ===8 ) 
                      
                    <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModalCenter">  Reject Report</button>
                    <a onclick="return confirm('Consider the following before completing report : 1.All report fields must be appropriately checked 2.Completed Reports can not be edited after submision, you would be required to see system Administrator for unavoidable complains or changes.  Thank you')"  href="{{url('admin/pharm/report/hod_office/complete_report',['id' => $report_id])}}">
                    <button type="button" class="btn btn-success pull-right"> complete report</button>
                   </a>
                    @endif
                </div>
              </div>
          </div>
         </div>
    </div>
</div>
</div>

@endsection