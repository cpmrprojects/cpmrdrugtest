@extends('admin.layout.main')

@section('content')
<div class="">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-server bg-blue"></i>
                    <div class="d-inline">
                        <h5>Taskboard</h5>
                        <span>Welcome to Microbiology workspace</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Apps</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Taskboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card task-board">
                <div class="card-header" style="border-color: #f5365c;" >
                    @foreach($microproducts->groupBy('product_id') as $microproduct)
                    <label class="badge badge-warning" style="background-color:#f5365c; margin-right:5px;">
                       {{count($microproduct)}} 
                    </label>
                    @endforeach
                    <h3>Todos</h3>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="ik ik-chevron-left action-toggle"></i></li>
                            <li><i class="ik ik-rotate-cw reload-card" data-loading-effect="pulse"></i></li>
                            <li><i class="ik ik-minus minimize-card"></i></li>
                            <li><i class="ik ik-x close-card"></i></li>
                        </ul>
                    </div>
                </div>
                  <span class="" style="padding:5px">
                    <input class="form-control" id="listSearch1" type="text" placeholder="Type something to search list items">
                  </span>
                    
                <div class="card-body todo-task" style=" overflow-x: hidden;overflow-y: auto; height:350px; margin-bottom: 30px">
                    <div class="dd" data-plugin="nestable" >
                        <ul class="list-group" id="myList1">
                            @foreach($microproducts as $microproduct)
                            <li class="list-group-item dd-item" style="padding: 1px;border:1px" data-id="1">
                            <div class="dd-handle">
                                <div class="row align-items-center">
                                    <div class="col-lg-10 col-md-12">
                                        <p>
                                            <a data-toggle="modal" data-placement="auto" data-target="#demoModal{{$microproduct->id}}" title="View Product" href=""> 
                                            <span href="" class="badge badge-danger pull-right">
                                             {{$microproduct->productType->code}}|{{$microproduct->id}}|{{$microproduct->created_at->format('y')}}
                                             <sup style="font-size: 1px" >{{$microproduct->productType->code}}{{$microproduct->id}}{{$microproduct->created_at->format('y')}}</sup>
                                           
                                            </span>
                                            </a>  
                                          <span></span>
                                        </p>
                                    </div> 
                                    <div class="col-lg-2 col-md-12">
                                           <a data-toggle="modal" data-placement="auto" data-target="#demoModal{{$microproduct->id}}" title="View Product" href=""><i class="ik ik-eye"></i></a>   
                                    </div>                                                           
                                    
                                </div>  
                                 
                            </div>
                            </li>
                            <div class="modal fade" id="demoModal{{$microproduct->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demoModalLabel"> Microbiology Product Details </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="card-body"> 
                                    
                                            <h6> Product</h6>

                                            <small class="text-muted ">{{$microproduct->productType->code}}|{{$microproduct->id}}|{{$microproduct->created_at->format('y')}}</small>
                                            <h6>Product Type </h6>
                                            <small class="text-muted ">{{ucfirst($microproduct->productType->name)}}</small>
                                            <h6>Quantity</h6>
                                            @foreach ($microproduct->departments->where('id',1) as $product)
                                            <small class="text-muted ">{{$product->pivot->quantity}}</small>
                                            @endforeach
                                            <small class="text-muted "></small>
                                            <h6>Indication</h6>
                                            <p class="text-muted"> {{ ucfirst($microproduct->indication)}}<br></p>
                                            <h6>Dosage</h6>
                                            <p class="text-muted"> {{ ucfirst($microproduct->dosage)}}<br></p>

                                            <hr><h5>Distribution Details</h5>

                                            <h6>Received By </h6>
                                            @foreach ($microproduct->departments->where('id',1) as $product)
                                            <small class="text-muted">{{\App\Admin::find($product->pivot->received_by)? \App\Admin::find($product->pivot->received_by)->full_name:'null'}}</small>
                                            @endforeach
                                            <h6>Distributed By </h6>
                                            @foreach ($microproduct->departments->where('id',1) as $product)
                                            <small class="text-muted">{{\App\Admin::find($product->pivot->distributed_by)?\App\Admin::find($product->pivot->distributed_by)->full_name:'null'}}</small>
                                            @endforeach
                                            <h6>Delivered By </h6>
       
                                            @foreach ($microproduct->departments->where('id',1) as $product)
                                            <small class="text-muted">{{\App\Admin::find($product->pivot->delivered_by)?\App\Admin::find($product->pivot->delivered_by)->full_name:'null'}}</small>
                                            @endforeach
                                         
                                            {{-- 
                                            <hr><h5>Customer Details</h5>
                                            <h6>Name</h6>
                                            <small class="text-muted ">{{ucfirst($microproduct->customer->name)}}</small>
                                            <h6>Tell</h6>
                                            <small class="text-muted ">{{ucfirst($microproduct->customer->tell)}}</small>
                                            <hr><h5>Distribution Periods</h5>
                                            
                                            <div  style="margin-bottom: 5px">
                                            <h6 >product distribution period</h6>
                                                <small class="text-muted">
                                                @foreach ($microproduct->departments as $product)
                                                Date: <small class="text-muted ">{{$product->pivot->created_at->format('Y-m-d')}}</small>
                                                Time: <small class="text-muted ">{{$product->pivot->created_at->format('H:i:s')}}</small>
                                                @endforeach
                                            </small>
                                            </div> --}}

                                            <h6> product delivery period</h6>

                                            <small class="text-muted ">
                                                @foreach ($microproduct->departments as $product)
                                                {{-- Date: <small class="text-muted ">{{$product->pivot->updated_at->format('Y-m-d')}}</small><br>
                                                Time: <small class="text-muted ">{{$product->pivot->updated_at->format('H:i:s')}}</small> 
                                                --}}
                                                @endforeach
                                            </small>

                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-color: #ffc107;" >
                    @foreach($microproduct_withtests->groupBy('product_id') as $microproduct_withtest)
                    <label class="badge badge-warning" style="background-color: #ffc107; margin-right:5px;">
                       {{count($microproduct_withtest)}} 
                    </label>
                    @endforeach
                    <h3>Under Analysis</h3>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="ik ik-chevron-left action-toggle"></i></li>
                            <li><i class="ik ik-rotate-cw reload-card" data-loading-effect="pulse"></i></li>
                            <li><i class="ik ik-minus minimize-card"></i></li>
                            <li><i class="ik ik-x close-card"></i></li>
                        </ul>
                    </div>
                </div>
                   <span class="" style="padding:5px">
                    <input class="form-control" id="listSearch" type="text" placeholder="Type something to search list items">
                    </span>
               
                  <div class="card-body progress-task" style=" overflow-x: hidden;overflow-y: auto; height:350px; margin-bottom: 30px">
                        
                        <ul class="list-group" id="myList">
                            @foreach($microproduct_withtests->sortBy('micro_hod_evaluation') as $microproduct_withtest)
                          <li class="list-group-item" style="padding: 1px;border:1px">
                            <div class="dd-handle">
                                    
                                <div class="card-body feeds-widget">
                                <div class="feed-item">
                                    <a href="{{ route('admin.microbial_report.show',['id' => $microproduct_withtest->id]) }}">
                                        <div class="feeds-left"><i class="ik ik-check-square text-warning"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="">
                                                  <span href="" class="badge badge-warning pull-right">
                                                    {{$microproduct_withtest->productType->code}}|{{$microproduct_withtest->id}}|{{$microproduct_withtest->created_at->format('y')}}
                                                <sup style="font-size: 1px" >{{$microproduct_withtest->productType->code}}{{$microproduct_withtest->id}}{{$microproduct_withtest->created_at->format('y')}}</sup>
                                                  
                                                </span>
                                                  <span href="" class="badge pull-right">
                                                  <p style="font-size: 10px;margin: 2px"></p>
                                                  </span><br>
                                              
                                                   <span><small class="float-right ">  <strong>Test:</strong> {{count($microproduct_withtest->loadAnalyses)}}mla
                                                    @foreach ($microproduct_withtest->loadAnalyses->groupBy('id')->first() as $loadnalyses)
                                                    @endforeach
                                                    @if ($loadnalyses->pivot->load_analyses_id ===3)
                                                             /tm count
                                                    @endif
                                                    @if (count($microproduct_withtest->efficacyAnalyses)>0)
                                                    & {{count($microproduct_withtest->efficacyAnalyses)}}ea
                                                    @endif
                                                    
                                                  </small>
                                                 </span><br>   
               
                                            </h4>
                                        
                                            <span>
                                               
                                            <small class="float-right font"><strong>Assigned: </strong>{{\App\Admin::find($microproduct_withtest->micro_analysed_by)? \App\Admin::find($microproduct_withtest->micro_analysed_by)->full_name:'null'}}</small><br>
                                            </span>
                                        
                                              <span>
                                              <small class="float-right font" > <strong>Evaluation: </strong> {!! $microproduct_withtest->report_evaluation !!}</small>
                                              <span>
                                                  @if ($microproduct_withtest->micro_grade != null )
                                                  <span>
                                                    <small class="float-right font" style="margin: 0.5px"> <strong>Grade: </strong> {!! $microproduct_withtest->micro_grade_report !!}</small>
                                                 <span>  
                                                  @endif 

                                        </div>
                                    </a>
                                    <span class="float-right font">
                                        <a onclick="return confirm('Are you sure of deleting record?')" href="{{route('admin.micro.report.delete',['id' =>$microproduct_withtest->id ])}}">
                                          <i style="color: rgb(200, 8, 8)" class="ik ik-trash-2"> delete </i>
                                        </a>
                                         
                                    </span>
                                    <span style="font-size:10px">
                                        @foreach($microproduct_withtest->loadAnalyses as $temp)
                                        @if($microproduct_withtest->loadAnalyses->first() == $temp)
                                        {{$temp->created_at->format('d/m/y')}}
                                        @endif
                                        @endforeach
                                    </span>
                                </div>
                                </div>
             
                            </div>
                              
                          </li>

                          @endforeach
                        </ul>
                  </div>
            </div>
        </div>   
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-color:#26c281; margin:5px">
                    @foreach($microproduct_completedtests->groupBy('product_id') as $microproduct_completedtest)
                    <label class="badge badge-warning" style="background-color: #26c281; margin-right:5px;">
                       {{count($microproduct_completedtest)}} 
                    </label>
                    @endforeach
                    <h3>Completed</h3>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="ik ik-chevron-left action-toggle"></i></li>
                            <li><i class="ik ik-rotate-cw reload-card" data-loading-effect="pulse"></i></li>
                            <li><i class="ik ik-minus minimize-card"></i></li>
                            <li><i class="ik ik-x close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <span class="" style="padding:5px;">
                    <input class="form-control" id="listSearch2" type="text" placeholder="Type something to search list items">
                    </span>
                <div class="card-body completed-task" style=" overflow-x: hidden;overflow-y: auto; height:350px;margin-bottom: 30px">
                    <div class="dd" data-plugin="nestable">
                        <ul class="dd-list list-group" id="myList2">                                   
                           
                            @foreach($microproduct_completedtests as $microproduct_completedtest)
                            <li class="list-group-item" style="padding: 1px;border:1px">
                              <div class="dd-handle">
                                      
                                  <div class="card-body feeds-widget">
                                  <div class="feed-item">
                                      <a target="_blank" href="{{ route('admin.micro.printreport',['id' => $microproduct_completedtest->id]) }}">
                                          <div class="feeds-left"><i class="ik ik-square text-warning"></i></div>
                                          <div class="feeds-body">
                                              <h4 class="">
                                                  <span href="" class="badge badge-success pull-right">
                                                  {{$microproduct_completedtest->productType->code}}|{{$microproduct_completedtest->id}}|{{$microproduct_completedtest->created_at->format('y')}}
                                                <sup style="font-size: 1px" > {{$microproduct_completedtest->productType->code}}{{$microproduct_completedtest->id}}{{$microproduct_completedtest->created_at->format('y')}}</sup>
                                                </span>                
                                                <small class="float-right text-muted">{{count($microproduct_completedtest->loadAnalyses)}} MLA Tests</small><br>
                                                @if (count($microproduct_completedtest->efficacyAnalyses)>0)
                                                <small class="float-right text-muted">{{count($microproduct_completedtest->efficacyAnalyses)}} MEA Tests</small><br>
                                            @endif
  
                                              </h4>
                                               @foreach($microproduct_completedtest->microbialloadReports->groupBy('id')->first() as $completedreport)
                                             <span>
                                              <small class="float-right font">Assigned {{\App\Admin::find($completedreport->added_by_id)? \App\Admin::find($completedreport->added_by_id)->full_name:'null'}}</small>
  
                                              </span>
                                                @endforeach 
                                          </div>
                                      </a>
                                  </div>
                                  </div>
               
                              </div>
                                
                            </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <ul class="nav justify-content-center" style="margin-top: 10px"> 
              <h4>CREATE MICROBIAL REPORT</h4>
            </ul>
            <div class="card-body">
                <form action="{{route('admin.micro.report.create_test')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row align-items-center">
                                                   
                       <div class="col-lg-12 col-md-12">
                        <div class="col-lg-6 col-md-12">
                            <h3 class="card-title"></h3>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="card-header"><h3>Select required product to begin report</h3></div>
                                   
                                     <select name="micro_product_id" required="required" id="microproduct_id" style="" class="form-control select2">
                                        <option value="">Select Product</option>
                                        @foreach($microproducts as $microproduct)
                                       <option product_typestate="7777{{$microproduct->productType->state}}" product_typeform="8888{{$microproduct->productType->form}}" value="{{$microproduct->id}}" {{$microproduct->id == old('products')? "selected":""}}> 
                                        {{$microproduct->productType->code}}|{{$microproduct->id}}|{{$microproduct->created_at->format('y')}}
                                        {{ucfirst($microproduct->name)}} 
                                      </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('micro_product_id')
                                <small style="margin-left:15px;margin-top:-10; margin-bottom:5px" class="form-text text-danger" role="alert">
                                <strong>{{$message}}</strong>
                                </small>
                                @enderror
                            </div>  
                        </div>  
                    </div>
                
                        <div class="col-sm-12 1 box" style="display: none">
                            <div class="card">
                                <div class="card-header d-block">
                                    <div class="card-header"><h3>Microbial Load Analysis</h3></div>
                                </div>
                                <div class="card-body p-0 table-border-style">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Test Conducted</th>
                                                    <th id="stateresult" class="77772">Result/Unit (CFU/g)</th>
                                                    <th>Acceptance Criterion
                                                         <span class="font">
                                                        (BP @foreach ($MicrobialLoadAnalysis->groupBy('id')->first()  as $item)
                                                        {{$item->expired_at}}
                                                        <input type="hidden" name="date_template" value="{{$item->date}}">
                                                           @endforeach )
                                                       </span></th>
                                                       
                                                    <th>Compliance Statement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < count($MicrobialLoadAnalysis->where('action',1)); $i++)
                                                <tr>
                                                    <td class="font" style="">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="mltest_id[]" value="{{$MicrobialLoadAnalysis[$i]->id}}" class="custom-control-input" checked="">
                            
                                                            <span class="custom-control-label">&nbsp;</span>
                                                        </label> 
                                                    </td>
                                                    <td class="font">
                                                        {{$MicrobialLoadAnalysis[$i]->test_conducted}}
                                                        <input type="hidden" class="form-control" name="test_conducted_{{$MicrobialLoadAnalysis[$i]->id}}" placeholder="Result" value="{{$MicrobialLoadAnalysis[$i]->test_conducted}}">
                                                    </td>
                                                    <td class="font">
                                                        <input type="text" class="form-control {{$i<2?'date-inputmask':''}}" required name="result_{{$MicrobialLoadAnalysis[$i]->id}}"  placeholder="{{$i>1?'Result':''}}" value="{{$MicrobialLoadAnalysis[$i]->result}}">
                                                    </td>
                                                    <td class="font">
                                                        
                                                        <input type="text" class="form-control {{$i<2?'date-inputmask':''}}" required name="acceptance_criterion_{{$MicrobialLoadAnalysis[$i]->id}}"  placeholder="{{$i>1?'Acceptance Criterion':''}}" id="expresult-{{$MicrobialLoadAnalysis[$i]->id}}" value="{{$MicrobialLoadAnalysis[$i]->acceptance_criterion}}">
                                                    </td>
                                                    <td class="font">
                                                        <select name="mlcompliance_{{$MicrobialLoadAnalysis[$i]->id}}" class="form-control" id="exampleSelectGender">
                                                            <option value="">None</option>
                                                            <option value="1">Failed</option>
                                                            <option value="2">Passed</option>
                                                        </select>
                                                      </td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                        </div> 
                    
                        <div class="col-sm-12 2 box" style="display: none">
                            <div class="card">
                                <div class="card-header d-block">
                                    <div class="card-header"><h3>Microbial Efficacy Analysis</h3></div>
                                </div>
                                <div class="card-body p-0 table-border-style">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="">#</th>
                                                    <th>Pathogen</th>
                                                    <th>Product Inhibition Zone</th>
                                                    <th>Ciprofloxacin Inhibition Zone</th>
                                                    <th>Fluconazole Inhibition Zone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($MicrobialEfficacyAnalysis->where('action',1) as $metest)
                                                <tr>
                                                    <td class="font" style="">      
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="metest_id[]" value="{{$metest->id}}" class="custom-control-input" checked="true">
                            
                                                            <span class="custom-control-label">&nbsp;</span>
                                                        </label> 
                                                    </td>
                                                    <td class="font">{{$metest->pathogen}}</td>
                                                    <input type="hidden" class="form-control" name="pathogen_{{$metest->id}}" value="{{$metest->pathogen}}">

                                                    <td class="font">
                                                        <input type="text" class="form-control" required name="pi_zone_{{$metest->id}}" placeholder="PI Zone" value="{{$metest->pi_zone}}">
                                                    </td>
                                                    <td class="font">
                                                        <input type="text" class="form-control" name="ci_zone_{{$metest->id}}" value="{{$metest->ci_zone}}">
                                                    </td>

                                                    <td class="font">
                                                        <input type="text" class="form-control" name="fi_zone_{{$metest->id}}"  value="{{$metest->fi_zone}}">
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                       </div>
                        <div id="visitfromworld" style="width:100%;">
                        </div>
              
                     <div class="card-body"> 
                        <div class="card-header"><h3>Check to indicate test type</h3></div>
                        <div class="row" style="margin-top: 10px">
                        <div class="col-sm-3" id="fadeout" >
                            <label class="custom-control custom-checkbox" >
                                <input type="checkbox" required class="custom-control-input" name="loadanalyses" id="inlineCheckbox1" value="1">
                                <span class="custom-control-label">&nbsp;Microbial Load Analysis</span>
                            </label>
                            @error('loadanalyses')
                            <small style="margin:15px" class="form-text text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </small>
                            @enderror
                            {{-- <input type="hidden" name="doublecheck"> --}}
                            @error('doublecheck')
                            <small style="margin:15px;" class="form-text text-danger" role="alert">
                                <strong style="color:#000">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                        {{--                       
                        <div class="col-sm-3"  id="fadeout2"  >
                            <label class="custom-control custom-checkbox" >
                                <input type="checkbox"  class="custom-control-input microcount" name="microbialcount" id="microbial_count" value="3">
                                <span class="custom-control-label">&nbsp;Too Many Microbial Count</span>
                            </label>
                            @error('microbialcount')
                            <small style="margin:15px" class="form-text text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </small>
                            @enderror
                        </div> --}}
                        <div class="col-sm-3" style="background:#d49f0a;">
                            <label class="custom-control custom-checkbox" style="margin-top:5px">
                                <input type="checkbox" class="custom-control-input" name="efficacyanalyses" id="inlineCheckbox2" value="2">
                                <span class="custom-control-label" style="color:#fff">&nbsp;Microbial Efficacy Analysis</span>
                            </label>
                            @error('efficacyanalyses')
                            <small style="margin:15px;" class="form-text text-danger" role="alert">
                                <strong style="color:#fff">{{$message}}</strong>
                            </small>
                            @enderror
                        </div>
                       
                        <div class="col-sm-3">
                            <button type="submit" style="float:right" class="btn btn-primary mb-2">Submit Report </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- {{$micro_report}} --}}
@endsection

@section('bottom-scripts')
<script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    
@endsection