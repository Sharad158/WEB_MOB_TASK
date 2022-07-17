<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)

        ->addColumn('action', function ($data) {
             $id = $data->blog_id;
             $edit = '<a class="label label-success badge badge-light-success" href="' . route('blog.edit',$id) . '"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>';
             
             $delete = '<a class="label label-danger badge badge-light-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm('.$id.')"><i class="fa fa-trash"></i>&nbsp</a>';

             $view = '<a class="label label-primary badge badge-light-primary" href="'. route('blog.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';

            return $view.' '.$edit.' '.$delete.' ';
        })
        ->addColumn('status',  function($data) {
            $id = $data->blog_id;
            $status = $data->status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-success';
                $label='Active';
            }
           
            return  '<a class="'.$class.' actStatus" id = "user'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })
        ->editColumn('category_id', function($data) {
            $categories = explode(',',$data->category_id);
            foreach($categories as $val){
                $name[] = Category::where('category_id',$val)->pluck('name');
            }
            return $name;
            // return Category::whereIn('category_id',$categories)->pluck('name');
        })
        ->editColumn('created_at', function($data) {
            return Carbon::parse($data->created_at)->format('d-M-Y');
        })
        ->rawColumns(['status','action','created_at']);//->toJson();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blog $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('blog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Blog_' . date('YmdHis');
    }
}
