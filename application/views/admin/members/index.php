<style>
    .cstm_subdrop {
        background-color: #2fbd8f !important;
        color: #fff !important;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
                    <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>
                    <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <!-- <th>Image</th> -->
                                    <th>Service</th>
                                    <th>Service Type</th>
                                    <th>Company Name</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact No.</th>
                                    <th>Company Address</th>
                                    <th>City</th>
                                    <th>Neighborhood</th>
                                    <th>Status</th>
                                    <th>Rating</th>
                                    <th>Search Time</th>
                                    <th style="width: 100px">Join Date</th>
                                    <th>Action</th>
                                </tr>
                                <?php if(is_array($members) && count($members)>0){
                                $i=1;
                                foreach ($members as $member) { ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <!-- <td><img src="<?=site_url('assets/images/cms/'.$member->image)?>" title="<?=$pages->title?>" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td> -->
                                    <td><?php if($member->owner_type==1){ echo "Business Owner";} else{ echo"Service Provider";}?></td>
                                    <td>
                                    <?php $s_id=$member->service_type;
                                    $s_type=$this->db->get_where('sub_service',array('id'=>$s_id,'status'=>1))->row();
                                    echo $s_type->name; ?>
                                    </td>
                                    <td><?=$member->company_name?></td>
                                    <td><?=$member->contact_prsn_fname.' '.$member->contact_prsn_lname?></td>
                                    <td><?=$member->contact_prsn_mobile?></td>
                                    <td><?=$member->company_addr?></td>
                                    <td><?php $city=$this->db->get_where('city',array('id' =>$member->city))->row(); ?><?=$city->name?></td> 
                                    <td><?php $neigh=$this->db->get_where('city',array('id' =>$member->neihborhood))->row(); ?><?=$neigh->name?></td>
                                    <td>
                                        <?php if($member->admin_status == 1) { ?>
                                        <a href="<?=admin_url('members/deactivate/'.$member->id)?>"><span class="badge bg-green">Active</span></a>
                                        <?php } else { ?>
                                        <a href="<?=admin_url('members/activate/'.$member->id)?>"><span class="badge bg-red">Inactive</span></a>
                                        <?php } ?>                          
                                    </td>
                                    <td><?=$member->rating?></td>
                                    <td><?php $st=$this->db->get('searchmsg')->row(); echo $st->s_time; ?></td>
                                    <td><?=date('d M Y',strtotime($member->created_at))?> </td>
                                    <td>
                                        <div class="action-button">
                                            <a href="<?=admin_url('members/add/'.$member->id)?>"><span class="fa fa-plus"></span></a>
                                            <a href="<?=admin_url('members/delete/'.$member->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; } } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>