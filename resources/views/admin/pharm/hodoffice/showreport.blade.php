@extends('admin.layout.main')

@section('content')
<div class="container-fluid">
    <div class="card" style="padding: 15px">
         <div class="text-center"> 
           <img src="{{asset('admin/img/logo.jpg')}}" class="" width="9%">
           <h4 class="font" style="font-size:18px"> Centre for Plant Medicine Research </h4>
           <p class="card-subtitle">Pharmacology & Toxicology Department</p>
          </div>

       <div class="card">
           <h4 class="font" style="font-size:18px; margin:20px; margin-top:15px"><strong> PRODUCT DETAILS</strong></h4>
           <div class="table-responsive">
               <table class="table">
                   <tbody>
                       <tr>
                           <td class="font"> <strong>Product:</strong></td>
                           <td class="font">
                               {{$pharmreports->productType->code}}|{{$pharmreports->id}}|{{$pharmreports->created_at->format('y')}} 
                           </td>
                       </tr>
                       <tr>
                           <td class="font"><strong>Date Recievied:</strong></td>
                           <td class="font">
                            
                            @foreach (\App\ProductDept::where('product_id',$pharmreports->id)->where('dept_id',2)->get() as $item)
                                {{$item->updated_at->format('d/m/Y')}}
                            @endforeach
                          </td>
                            
                       </tr>
                       <tr>
                           <td class="font"><strong>Date of Report:</strong></td> 
                           <td class="font">{{$pharmreports->pharm_dateanalysed}}</td>
                       </tr>
                       <tr>
                           <td class="font"><strong>Test Conducted</strong></td>
                           <td class="font">{{\App\PharmTestConducted::find($pharmreports->pharm_testconducted)->name}}</td>
                           <input type="hidden" id="pharm_test_conducted" value="{{\App\PharmTestConducted::find($pharmreports->pharm_testconducted)->id}}">  
                           
                       </tr>
                       <tr>
                           <td></td>
                           <td></td>
                       </tr>
                   </tbody>
               </table>
           </div>
       </div>
       
       <div class="card test1" style="display: none;">
          <div class=""> 
           <h4 class="font" style="font-size:18px; margin:10px; margin-top:15px"><strong> RESULTS: </strong></h4>

           <p class="font" style="font-size:14px; margin:20px; margin-top:10px"> Table showing Result of Acute Toxicity on {{$pharmreports->productType->code}}|{{$pharmreports->id}}|{{$pharmreports->created_at->format('y')}} |   {{ucfirst($pharmreports->name)}} in 
               @foreach ($pharmreports->animalExperiment->groupBy('id')->first() as $item)
               {{$item->pharm_animal_model}}
               @endforeach
           </p>
          </div>

          <table class="table">
                <tbody>   
                    <tr>
                        <td class="font"><strong>Animal Model</strong></td>
                        <td class="font">
                            {{$pharm_finalreports->pharm_animal_model}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>No. of Animals</strong></td>
                        <td class="font">
                            {{$pharm_finalreports->num_of_animals}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Sex</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->animal_sex}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>No. of Groups</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->no_group}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Route of Administration</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->method_of_admin}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Formulation</strong></td> 
                        <td  class="font">{{$pharm_finalreports->formulation}}</td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Preparation</strong></td> 
                    <td  class="font">{{$pharm_finalreports->preparation}}</td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Dose Administered (Mg/Kg)</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->dosage}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Period of Observation</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->no_days}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>No. of Death Recorded</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->no_death}}
                        </td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Estimated Median Letha Dose (LD/50)</strong></td> 
                        <td  class="font">{{$pharm_finalreports->estimated_dose}}</td>
                    </tr>
                    <tr>
                        <td class="font"><strong>Phisical Sign of Toxicity</strong></td> 
                        <td  class="font">
                            {{$pharm_finalreports->signs_toxicity}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
          </table>    
         <div class="card" style="padding: 1%">
        <h4 class="font" style="font-size:18px; margin:10px; margin-top:1px"><strong> REMARKS: </strong></h4>
             <p style="font-size: 16px">
                {{$pharmreports->pharm_comment}}   
             </p>       
        </div>  
      </div>

       <div class="card test2" style="display: none;padding: 2%">
        <p style="font-size:16px">{{$pharmreports->pharm_standard}}</p>

        <h4 class="font" style="font-size:18px; margin:10px; margin-top:15px"><strong> RESULTS: </strong></h4>
        <p style="font-size: 15px">
            {{$pharmreports->pharm_result}}   
        </p> 
        
        <h4 class="font" style="font-size:18px; margin:20px; margin-top:15px"> <strong>REMARKS: </strong></h4>

        <p style="font-size: 15px">
            {{$pharmreports->pharm_comment}}   
        </p>  
       </div>

       <div class="col-md-12">
        <strong><span>REPORT GRADE:</span></strong>
        <p>{!! \App\Product::find($pharmreports->id)->pharm_grade_report !!} </p><br><br>
       </div>


        <div class="row" style="margin: 35px">
          <div class="col-sm-4 invoice-col">
            <?php
            $pharm_analysed_by = (\App\Product::find($pharmreports->id)? \App\Product::find($pharmreports->id)->pharm_analysed_by:'');
            $user_type         = (\App\Admin::find($pharm_analysed_by)? \App\Admin::find($pharm_analysed_by)->user_type_id:'');
            ?>
            <p>Analyzed By</p><br>
            @if (\App\Product::find($pharmreports->id)->pharm_hod_evaluation >null)
            <img src="{{asset(\App\Admin::find($pharm_analysed_by)? \App\Admin::find($pharm_analysed_by)->sign_url:'')}}" class="" width="42%"><br>
            @endif
            -----------------------------<br>
        
            <span>{{ucfirst(\App\Admin::find($pharm_analysed_by)? \App\Admin::find($pharm_analysed_by)->full_name:'')}}</span>
            <p>{{ucfirst(\App\UserType::find($user_type )? \App\UserType::find($user_type )->name:'')}}</p>

        </div> 
        <div class="col-sm-4 invoice-col">
            
            </div>
            <div class="col-sm-4 invoice-col">
                <?php
                $pharm_appoved_by = (\App\Product::find($pharmreports->id)? \App\Product::find($pharmreports->id)->pharm_appoved_by:'');
                $hod_user_type = (\App\Admin::find($pharm_appoved_by)? \App\Admin::find($pharm_appoved_by)->user_type_id:'');

                ?>
                <p>Supervisor</p><br>
                @if (\App\Product::find($pharmreports->id)->pharm_hod_evaluation ==2)
                <img src="{{asset(\App\Admin::find($pharm_appoved_by)? \App\Admin::find($pharm_appoved_by)->sign_url:'')}}" class="" width="42%"><br>
                @endif

                ------------------------------<br> 
            
            <span>{{ucfirst(\App\Admin::find($pharm_appoved_by)? \App\Admin::find($pharm_appoved_by)->full_name:'')}}</span>
            <p>{{ucfirst(\App\UserType::find($hod_user_type)? \App\UserType::find($hod_user_type)->name:'')}}</p>

            </div>
        </div>


        <div class="col-12">
            <div class="row" style="margin-top: 110px">
                <div class="col-md-6" style="margin-right: 16%">
                  @if (\App\Product::find($report_id)->pharm_hod_evaluation <2)
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fa fa-credit-card"></i> Approve Report</button>
                  @endif
                  @if (\App\Product::find($report_id)->pharm_hod_evaluation ==2) 
                 <a href="{{ old('redirect_to', URL::previous())}}">
                  <div class="alert alert-success" role="alert">
                      Report succesfully completed. Final report of {{\App\Product::find($report_id)->productType->code}}|{{\App\Product::find($report_id)->id}}|{{\App\Product::find($report_id)->productType->created_at->format('y')}}  will be printed by SID 
                  </div>
                 </a>
                 
                 @endif
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                    
                           <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalCenterLabel">Please Sign to evaluate report</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              </div>
                              <div class="modal-body">
                                  <form  id="pharmhodapproveform" sign-user-url="{{route('admin.pharm.hod_office.checkhodsign')}}" action="{{route('admin.pharm.hod_office.evaluatereport',['id' => $report_id])}}" class="" method="POST">
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
                                          @error('password')
                                          <small style="margin-left:120px;margin-top:-10; margin-bottom:5px" class="form-text text-danger" role="alert">
                                              <strong>{{$password}}</strong>
                                          </small>
                                          @enderror
                                          <span class="input-group-prepend"><label class="input-group-text"><i class="ik ik-shield"></i></label></span>
                                          <input required id="userpassword" type="password" class="form-control" name="password" placeholder="Sign with password">
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
                     @if (\App\Product::find($report_id)->pharm_hod_evaluation ==2) 
                    
                  <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModalCenter">  Reject Report</button>
                 <a target="_blank" href="{{url('admin/pharm/report/hod_office/complete_report',['id' => $report_id])}}">
                  <button type="button" onclick="return confirm('Consider the following before completing report : 1.All report fields must be appropriately checked 2.Completed Reports can not be edited after submision, you would be required to see system Administrator for unavoidable complains or changes.  Thank you')" class="btn btn-success pull-right">  Complete Report</button>
                 </a>
                  @endif
              </div>
           </div>
          </div>
       </div>
   
</div>


@endsection