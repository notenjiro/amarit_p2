<style>
    .w-5{
        width: 100px!important
    }
</style>

<div class="modal-body"> 
                <form id="hotel_data">
                    <div id="insert_area">
                        <div class="row">  
                            <div class="col-2">   
                                <div class="form-group">
                                    <span class="label success">Hotel booking ID</span>
                                    <input type="text" name="hotel_id" id="hotel_id" class="form-control" readonly> 
                                    <!-- fix -->
                                </div>
                            </div>
                            
                        </div>
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Descriptior</span>
                                    <textarea name="textarea" name="hotel_des" id="hotel_des" class="form-control" rows="4" cols="40" style="resize: none; overflow-y: hidden; " maxlength="150"></textarea>
                                </div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>QTY</span><span style="color:red"> *</span>
                                    <input type="number" name="quantity" id="hotel_qty" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group">
										<span>Include breakfast</span>
										<input type="checkbox"  value="1" id="hotel_Include_breakfast" name="hotel_Include_breakfast" class="form-check">
								</div>
                                
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <input name="uom" id="hotel_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                </div>
                                <div class="form-group">
										<span>Extra bed</span>
										<input type="checkbox"  value="1" id="Extra_bed" name="Extra_bed" class="form-check">
								</div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Room Type</span><span style="color:red"> *</span>
                                    <select name="Room" id="hotel_type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Hotel name</span>
                                    <select name="name" id="hotel_name" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Charge as</span><span style="color:red"> *</span>
									<input name="charge_as" id="hotel_charge_as" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col">   
                                <div class="form-group">
                                    <span>Chech-in date/time</span><span style="color:red"> *</span>
                                    <input type="date" name="check_in" id="hotel_check_in_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">   
                                <div class="form-group">
                                    <span>Chech-out date/time</span><span style="color:red"> *</span>
                                    <input type="date" name="check_out" id="hotel_check_out_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Location</span>
                                    <input type="text" name="hotel_location" id="hotel_location" class="form-control" maxlength="50">
                                </div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Contract number</span><span style="color:red"> *</span>
                                    <input name="Contract" id="hotel_Contract" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    </select>
                                </div>
                                <div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="no_charge" name="no_charge" class="form-check">
								</div>
                                
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Cost center & Department</span><span style="color:red"> *</span>
                                    <input type="text" name="CnD" id="hotel_CnD" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group">
										<span>Lump-sum charge</span>
										<input type="checkbox"  value="1" id="Lump-sum" name="Lump-sum" class="form-check">
								</div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Client type</span><span style="color:red"> *</span>
                                    <select name="client" id="hotel_client_type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
									<span>Reimbursment</span>
									<input type="checkbox"  value="1" id="Reimbursment" name="Reimbursment" class="form-check">
								</div>
                            </div>
                            
                        </div>
                        




                    </div>
                    <div class= "row">
                        <div class="col-6"> 
                            <br>
                            <button style="width:100px" type="submit" class="btn btn-success" id="hotel_submit" data-bs-target="#" >
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button style="width:100px" type="button" class="btn btn-danger"  id="hotel_cancel" data-bs-target="#" >
                                <i class="fas fa-minus-square"></i> Cancel
                            </button>
                            <input type="hidden" id="contact_id">
                            <input type="hidden" id="user_name">
                        </div>
                    </div>
                </form>
</div>  

<script>

$(document).ready(function(){
		
    $("#hotel_cancel").on('click',function(){
		$('#viewhotelmodal').modal('hide');
    })

});



</script>