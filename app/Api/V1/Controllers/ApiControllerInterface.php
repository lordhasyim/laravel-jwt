<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 8/18/17
 * Time: 3:55 PM
 */
namespace app\Api\V1\Controllers;
use Illuminate\Http\Request;
interface ApiControllerInterface
{
    public function index(Request $request);
    public function dataTable();
    public function getAll();
    public function show($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}
