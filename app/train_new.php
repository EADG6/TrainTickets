<form class="col-md-12">
<h2>Input New Train</h2>
<div class="col-md-12">
    <div class="form-group col-md-6">
        <label class="my-4">Train ID :</label>
        <input type="text" class="form-control form-control-lg" placeholder="Enter Train ID"> 
    </div>
    <div class="form-group col-md-6">
        <label class="col-md-12">Train Type :</label>
            <div class="col-md-6 form-group">
                Hight: <input type="checkbox" name="hight" value="">
            </div>
            <div class="col-md-6 form-group">
                Slow : <input type="checkbox" name="slow" value="">
            </div>
    </div>
    <div class="form-group col-md-6">
        <label class="col-md-12">City :</label>
        <div class="form-group col-md-6">
			<select class="form-control" onchange='selectCity(this)' name="scity" required>
				<option value=''>Start City...</option>
				<option value='1'>Chengdu</option>
                <option value='2'>Beijing</option>
                <option value='3'>Xian</option>
                <option value='4'>Shanghai</option>
            </select>
		</div>
		<div class="form-group col-md-6">
			<select class="form-control" onchange='selectCity(this)' name="ecity" required>
				<option value=''>End City...</option>
				<option value='1'>Chengdu</option>
                <option value='2'>Beijing</option>
                <option value='3'>Xian</option>
                <option value='4'>Shanghai</option>
            </select>
		</div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group col-md-6">
            <label>Start Time :</label>
            <input class="form-control" type="time" name="stime" value="">
        </div>
        <div class="form-group col-md-6">
            <label>End Time :</label>
            <input class="form-control" type="time" name="etime" value="">
        </div>
    </div>
    <div class="form-group col-md-12">
        <label class=>Seat Level :</label>
    </div>
    <div class="form-group col-md-12">
        <label>Seat Cariage</label>
            <select name="seatca" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
    </div>
    <div class="form-group col-md-12">
        <label>Hard Sleeper Cariage</label>
        <select name="hsleepca" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
    </div>
    <div class="form-group col-md-12">
        <label>Soft Sleeper Cariage</label>
        <select name="ssleepca" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
    </div> 
</div>
<div class="col-md-12" height="120px">
    <div class="col-md-6">
        <button href="#" class="btn btn-primary form-control">Update</button>
    </div>
    <div class="col-md-6">
        <button href="#" class="btn btn-primary form-control">Reste</button>
    </div>
</div>
</form>