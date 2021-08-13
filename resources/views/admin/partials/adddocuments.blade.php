
    <!-- Add Documnet TAB Content -->
<div class="card">
    <div class="card-body">
        <div class="row" id="tag_container">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" action="#" accept-charset="UTF-8" class="profile form-horizontal" enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="zWQidagfGUxbIvgL8yojnhhsIcNRwOzBOopvwRbO">
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-12 row col-xs-12">
                                            <!-- Aadhar Card Number -->
                                  




                                                    <!-- Add Files -->
                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <div class="clearfix"></div>
                                            
                                                {{ Form::label('Add Files:') }}
                                                <div class="clearfix"></div>
                                                    <a class="btn btn-outline-primary default mb-2 add_collapse" data-toggle="collapse" href="#add"> 
                                                        <i class="glyph-icon simple-icon-plus mr-1"></i> Add Files
                                                    </a>
                                                    <div class="collapse" id="add">
                                                        <div class="mt-4">
                                                            <form action="/file-upload">
                                                                <div class="dropzone" id="drop_here_auction">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <span class="error"> {{ $errors->first('temp_images')  }} </span>
                                                        <div class="dropzoneError errors" id="file_error"></div>
                                                            <input type="hidden" name="temp_images" id="temp_images" value="{{old('temp_images')}}">											
                                                        </div>





                                                                <!-- UPLOADED MEDIA PREVIEW  -->



                                                    {{--<div class="col-md-12 mt-4 media_uploaded" id="sortable">
                                                                    @if($newAuction == 2)
                                                                        @if(isset($auction->media) && $auction->media !== NULL)
                                                                            @foreach($auction->media as $media)
                                                                                @php $imageType='original'; @endphp
                                                                                @include('admin.auctions.imageGallery')
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    
                                                        </div>--}}
                                                                
                                                        <div class="col-md-12 mt-4 media_uploaded">									
                                                            <table class="table table-bordered media_uploaded_table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col">Media</th>
                                                                        <th scope="col" class="text-center">Download</th>
                                                                        <th scope="col" class="text-center">Remove</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="sortable">
                                                                                @if($newAuction == 2)
                                                                                    @if(isset($auction->media) && $auction->media !== NULL)
                                                                                        @foreach($auction->media as $media)
                                                                                            @php $imageType='original'; @endphp
                                                                                            @include('admin.auctions.imageGallery')
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endif
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="Thumbnail" src="http://127.0.0.1:8000/uploads/auctions/19/1849755105_auction_IMG_0725.jpeg" class="list-thumbnail responsive border-0">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="http://127.0.0.1:8000/admin/auctions/image_downlad/19/1106" class="filedownlad filedownlad-auction">
                                                                            <i class="glyph-icon simple-icon-cloud-download"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a title="Delete Media" data-id="1106" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete the Image?" data-left_button_name="Yes" data-left_button_id="delete_auction_media" data-left_button_cls="btn-primary" class="remove open_confirmBox action deleteMediaAuction" href="javascript:void(0)" data-media_id="1106" data-image_type="original" data-dz-remove="">
                                                                            
                                                                            <i class="glyph-icon simple-icon-trash"></i>
                                                                            </a>
                                                                        </td>  
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="Thumbnail" src="http://127.0.0.1:8000/uploads/auctions/19/1849755105_auction_IMG_0725.jpeg" class="list-thumbnail responsive border-0">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="http://127.0.0.1:8000/admin/auctions/image_downlad/19/1106" class="filedownlad filedownlad-auction">
                                                                            <i class="glyph-icon simple-icon-cloud-download"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a title="Delete Media" data-id="1106" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete the Image?" data-left_button_name="Yes" data-left_button_id="delete_auction_media" data-left_button_cls="btn-primary" class="remove open_confirmBox action deleteMediaAuction" href="javascript:void(0)" data-media_id="1106" data-image_type="original" data-dz-remove="">
                                                                            
                                                                            <i class="glyph-icon simple-icon-trash"></i>
                                                                            </a>
                                                                        </td>  
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <img alt="Thumbnail" src="http://127.0.0.1:8000/uploads/auctions/19/1849755105_auction_IMG_0725.jpeg" class="list-thumbnail responsive border-0">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="http://127.0.0.1:8000/admin/auctions/image_downlad/19/1106" class="filedownlad filedownlad-auction">
                                                                            <i class="glyph-icon simple-icon-cloud-download"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a title="Delete Media" data-id="1106" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete the Image?" data-left_button_name="Yes" data-left_button_id="delete_auction_media" data-left_button_cls="btn-primary" class="remove open_confirmBox action deleteMediaAuction" href="javascript:void(0)" data-media_id="1106" data-image_type="original" data-dz-remove="">
                                                                            
                                                                            <i class="glyph-icon simple-icon-trash"></i>
                                                                            </a>
                                                                        </td>  
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                            <button type="submit" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto mx-auto d-block">{{trans('global.submit')}}</button>
                                                </div>
                                    </div>           
                                                            
                                </div>
                            </div>
                        </div>
                    </form>




                </div>
            </div>
	    </div>
    </div>
</div>


                       