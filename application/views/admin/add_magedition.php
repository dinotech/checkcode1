<?php //print_r($vol);die;
$this->load->view('admin/my_header.php'); ?>
<!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                   <h1 class="heading">Add New Issue to the Magazine </h1>
                    
                    <div class="contents">                       
                        <form action="<?php echo base_url(); ?>admin/magazine/upload_vol?page=new" enctype="multipart/form-data" method="post">
                            <div class="table-box">
                                <table class="table datatable">
                                    <tbody>
	                                    <tr>                                        	
                                            <input type="hidden" name="parent_id" value="<?php echo $_GET['magzid'];?>" >
                                            <input type="hidden" name="vol" value="<?php echo $vol[0]['latestvolume'];?>" >
                                            <input type="hidden" name="issue" value="<?php echo ($vol[0]['latestissue']+1);?>" >											                                                                                        
                                            <td class="col-xs-2"><input type="text" name="" value="<?php echo 'Vol.'. $vol[0]['latestvolume'];?>" readonly class="form-control"></td>
                                            <td class="col-xs-2"><input type="text" name="" value="<?php echo 'Issue.'.($vol[0]['latestissue']+1);?>" readonly  class="form-control"></td></tr>
                                            <tr>
                                            <td>Enter Isuue name</td>
                                            <td class="col-xs-8"><input type="text" name="name" required="required" value="" placeholder="Enter IssueName" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td>Magazine Image</td>
                                            <td><input type="file" required="required" name="magvolimg" ></td>
                                        </tr> 
                                          <tr>
                                            <td>Magazine</td>
                                            <td><input type="file" required="required" name="magvol" id="magvol"  onchange="showing()"></td>
                                        </tr> 
                                        <tr>
                                       
                                            <td colspan="2"> 

<!--<a id="showpdf" class="view-pdf" href="../../assets/pdf/Magazine10.pdf"><button type="button" class="btn btn-success" name="publish">Preview</button></a>-->

<input type="submit" class="btn btn-success col-sm-2 col-sm-offset-4" name="submit" value="Preview" />
</td>
                                        </tr>                              
                                    </tbody>
                            	</table>
                            </div>
                        </form>                                                
                        <div class="clearfix">
                        </div>                        
                    </div>
                </div>
             </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Modal -->
<!-- Wrapper End -->
<script>
/*
* This is the plugin
*/
(function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);
alert(c);
var c=(b.scrollable===true)?'style="viewer-pdf-toolbar {	display:none !important;	}#buttons{	display:none !important;	}max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
html+="</div>";html+='<div class="modal-body" '+c+ ">";html+=b.message;html+="</div>"; html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);

/*
* Here is how you use it
*/
$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        //var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        //var iframe = '<object data="'+pdf_link+'" type="application/pdf"><embed src="'+pdf_link+'" type="application/pdf" /></object>'        
        var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
        $.createModal({
            title:'My Title',
            message: iframe,
            closeButton:true,
            scrollable:false
        });
        return false;        
    });    
})

function showing()
{
		$('#showpdf').attr("href",$('#magvol').val());
}
</script>
</body>
</html>
