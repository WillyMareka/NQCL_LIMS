<style>
    input.dissdata{
        width:60px;
    }

    table.toptable
    {
        border-width: 0 0 1px 1px;
        border-spacing: 0;
        border-collapse: collapse;
        border-style: solid;
    }

    table.toptable td
    {
        margin: 0;
        padding: 4px;
        border-width: 1px 1px 0 0;
        border-style: solid;
    }
    .toptable tr:hover {
        background-color: lightyellow;
    }
</style>
<table width="553" class="toptable" >
    <tr>
        <td width="33">No</td>
        <td width="62">Wgt(mg)</td>
        <td width="178">&nbsp;</td>
        <td width="130">&nbsp;</td>
        <td width="126">&nbsp;</td>
    </tr>
    <tr>
        <td>1</td>
        <td><input type="text" name="tc1" id="tc1" class="dissolution-class  dissdata" required/></td>
        <td>Dissolution Medium</td>
        <td>
   <input type="text" name="DM" placeholder="e.g. HCL" value="" id="DM" required="required" />
</td>
        <td><input type="text" name="textfield11" id="textfield11"></td>
    </tr>
    <tr>
        <td>2</td>
        <td><input type="text" name="tc2" id="tc2" class="dissolution-class dissdata" required /></td>
        <td>Volume Used (mL)</td>
        <td><input type="text" name="R2" placeholder="900" value="" id="R2" required="required" /></td>
        <td><input type="text" name="textfield12" id="textfield12"></td>
    </tr>
    <tr>
        <td>3</td>
        <td><input type="text" name="tc3" id="tc3" class="dissolution-class dissdata" required/></td>
        <td>Apparatus</td>
        <td>
             <select name="apparatus" id="apparatus">
                                <option value=""></option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                            </select></td>
        <td><select name="select3" id="select3">
            </select></td>
    </tr>
    <tr>
        <td>4</td>
        <td><input type="text" name="tc4" id="tc4" class="dissolution-class dissdata" required/></td>
        <td>RPM (rpm)</td>
        <td><input type="text" name="Rm" placeholder="" value="" id="Rm" required="required" />&nbsp;<span>rpm</span>
</td>
        <td><input type="text" name="textfield13" id="textfield13"></td>
    </tr>
    <tr>
        <td>5</td>
        <td><input type="text" name="tc5" id="tc5" class="dissolution-class dissdata" required/></td>
        <td>Time (mins)</td>
        <td><input type="text" name="textfield5" id="textfield5">
        <select id="time">
                                    <option value=""></option>
                                    <option value="">Hours</option>
                                    <option value="">Minutes</option>
                                </select> 
        </td>
        <td><input type="text" name="textfield14" id="textfield14">
            <select name="select4" id="select4">
            </select></td>
    </tr>
    <tr>
        <td>6</td>
        <td><input type="text" name="tc6" id="tc6" class="dissolution-class dissdata" required/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td height="26">Avg</td>
        <td>
            <input type="text" name="tcmean" id="tcmean" readonly />
        </td>    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

</table>
