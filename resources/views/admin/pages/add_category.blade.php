@extends('admin.admin_master')
@section('admin_main_content')

<div class="box span12">
    <div class="box-header" data-original-title>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
        </div>
    </div>
    <h2 style="color: green">
        <?php
            $message=Session::get('message');
            if($message)
            {
                echo $message;
                Session::put('message','');
            }
        
        ?>
    </h2>
    <h2 style="color:green">
        <?php
        $message=Session::get('message');
        if($message){
            echo $message;
            Session::put('message','');
        }

        ?>

    </h2>
 <div class="box-content">
               {!! Form::open(array('url' => '/save-category' , 'method'=>'post' )) !!}
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="typeahead">Category Name </label>
                    <div class="controls">
                        <input type="text" name="category_name" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >

                    </div>
                </div>



                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Category Description</label>
                    <div class="controls">
                        <textarea class="cleditor" id="textarea2" rows="3" name="category_description"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Publication Status</label>
                    <div class="controls">
                        <select id="selectError" data-rel="chosen" name="publication_status">
                            <option value='1'>Published</option>
                            <option value="0">Unpublished</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
       {!! Form::close() !!}  

    </div>
</div><!--/span-->

@endsection