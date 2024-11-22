<style>
    .w-5{
        width: 100px!important
    }
</style>

<div class="modal-body"> 
                <form id="ticket_data">
                    <div id="insert_area">
                        <div class="row">  
                            <div class="col-2">   
                                <div class="form-group">
                                    <span class="label success">Ticket booking ID</span>
                                    <input type="text" name="ticket_id" id="ticket_id" class="form-control" readonly> 
                                    <!-- fix -->
                                </div>
                            </div>
                            
                        </div>
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Descriptior</span>
                                    <textarea name="textarea" name="ticket_des" id="ticket_des" class="form-control" rows="4" cols="40" style="resize: none; overflow-y: hidden; " maxlength="150"></textarea>
                                </div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>QTY</span><span style="color:red"> *</span>
                                    <input type="number" name="quantity" id="ticket_qty" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group">
										<span>Include breakfast</span>
										<input type="checkbox"  value="1" id="ticket_Include_breakfast" name="ticket_Include_breakfast" class="form-check">
								</div>
                                
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>UOM</span><span style="color:red"> *</span>
                                    <input name="uom" id="ticket_uom" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                </div>
                                <div class="form-group">
										<span>Extra bed</span>
										<input type="checkbox"  value="1" id="Extra_bed" name="Extra_bed" class="form-check">
								</div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Ticket Type</span><span style="color:red"> *</span>
                                    <select name="ticket" id="ticket_type" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <span>Airline name</span>
                                    <select name="name" id="airline_name" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">  
                                <div class="form-group">
                                    <span>Charge as</span><span style="color:red"> *</span>
									<input name="charge_as" id="ticket_charge_as" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col">   
                                <div class="form-group">
                                    <span>Start date/time</span><span style="color:red"> *</span>
                                    <input type="date" name="check_in" id="ticket_start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">   
                                <div class="form-group">
                                    <span>End date/time</span><span style="color:red"> *</span>
                                    <input type="date" name="check_out" id="ticket_end_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-3">
                                <div class="form-group">
                                    <span>Location origin</span>
                                    <input type="text" name="ticket_origin" id="ticket_origin" class="form-control" maxlength="50">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <span>Location destination</span>
                                    <input type="text" name="ticket_destination" id="ticket_destination" class="form-control" maxlength="50">
                                </div>
                            </div>
                            <div class="col-2">  
                                <div class="form-group">
                                    <span>Contract number</span><span style="color:red"> *</span>
                                    <input name="Contract" id="ticket_Contract" class="form-control" aria-describedby="inputGroupPrepend2" required>
                                    </select>
                                </div>
                                
                                
                            </div>
                            <div class="col-2">  
                                <div class="form-group">
                                    <span>Cost center & Department</span><span style="color:red"> *</span>
                                    <input type="text" name="CnD" id="ticket_CnD" class="form-control" required>
                                    </select>
                                </div>
                                
                            </div>
                            
                        
                            
                        </div>
                        <div class="row">
                            <div class="col-6">
                                
                            </div>
                            <div class="col">  
                                <div class="form-group">
										<span>No charge</span>
										<input type="checkbox"  value="1" id="no_charge" name="no_charge" class="form-check">
								</div>  
                            </div>
                            <div class="col">  
                                <div class="form-group">
										<span>Lump-sum charge</span>
										<input type="checkbox"  value="1" id="Lump-sum" name="Lump-sum" class="form-check">
								</div>
                            </div>
                            <div class="col">  
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
                            <button style="width:100px" type="submit" class="btn btn-success" id="ticket_submit" data-bs-target="#" >
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button style="width:100px" type="button" class="btn btn-danger"  id="ticket_cancel" data-bs-target="#" >
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
		
    $("#ticket_cancel").on('click',function(){
		$('#viewticketmodal').modal('hide');
    })

});



</script>