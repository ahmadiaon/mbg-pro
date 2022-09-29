@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <div class="pd-20 col-12 card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Ritasi</h4>
                    </div>
                    <div class="col">
                        <div class="mb-0 float-right">
                                <button class="btn btn-primary" 
                                data-toggle="modal" data-target="#exampleModalCenter" >Tambah Operator</button>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-20 ">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="">Name</th>
                            <th class="">Unit</th>
                            <td>07:00</td>
                            <td>08:00</td>
                            <td>09:00</td>
                            <td>10:00</td>
                            <td>11:00</td>
                            <td>12:00</td>
                            <td>13:00</td>
                            <td>14:00</td>
                            <td>15:00</td>
                            <td>16:00</td>
                            <td>17:00</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            <label for="">Udin</label>
                        </td>
                        <td>
                           <label for="">Sanny 001</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td>
                            <button class="btn btn-primary">Simpan</button>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button>
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <select name="checker_employee_uuid" style="width: 100%" class="theSelect theSelect2"
                id="checker_employee_uuid">
                @foreach($employees as $employee)
                @if(old('checker_employee_uuid' ) == $employee->uuid)
                <option value="{{ $employee->uuid }}" selected>{{ $employee->name }}
                </option>
                @else
                <option value="{{ $employee->uuid }}">{{ $employee->name }}</option>
                @endif
                @endforeach
            </select>
               </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<div
    class="modal fade"
    id="Medium-modal"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Large modalsss
                </h4>
                <button
                    type="button"
                    data-dismiss="modal"
                    aria-hidden="true"
                >
                    ×
                </button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
     $(".theSelect2").select2();
</script>
{{-- <script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('ob-data') !!}',
            columns: [
                { data: 'date', name: 'date' },
                { data: 'name', name: 'name' },
                { data: 'shift', name: 'shift' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script> --}}
@endsection