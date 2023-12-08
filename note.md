# Todo List

-   [x] #739
-   [ ] https://github.com/octo-org/octo-repo/issues/740
-   [ ] Add delight to the experience when all tasks are
-   [ ] -
# Todo List Logistic
-   [ ] get predic number

# Todo List Admin HR

-   [ ] new people
-   [ ] edit people
-   [ ] new employee
-   [ ] edit employee
-   [ ] delete employee
-   [ ] new pkwt
-   [ ] renew pkwt
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
-   [ ] Add delight to the experience when all tasks are
        complete :tada:

# List of Code

-   Helper
-   John Adams
-   Thomas Jefferson

## The smallest heading

> Text that is a quote

```
git status
git addhjgghgh
git commit
```
> Merge PDF
```
$pdf = new Fpdi();
        // File pertama
   // File pertama
   $file1 = public_path('file/document/employee/11113_ktp_file.pdf');
   $pageCount1 = $pdf->setSourceFile($file1);
   for ($pageNum = 1; $pageNum <= $pageCount1; $pageNum++) {
       $templateId = $pdf->importPage($pageNum);

       // Set format halaman yang sesuai
       $size = $pdf->getTemplateSize($templateId);
       $orientation = $size['width'] > $size['height'] ? 'L' : 'P'; // Menyesuaikan orientasi

       $pdf->AddPage($orientation, [$size['width'], $size['height']]);
       $pdf->useTemplate($templateId);
   }

   // File kedua
   $file2 = public_path('file/document/employee/11113_file_kk.pdf');
   $pageCount2 = $pdf->setSourceFile($file2);
   for ($pageNum = 1; $pageNum <= $pageCount2; $pageNum++) {
       $templateId = $pdf->importPage($pageNum);

       // Set format halaman yang sesuai
       $size = $pdf->getTemplateSize($templateId);
       $orientation = $size['width'] > $size['height'] ? 'L' : 'P'; // Menyesuaikan orientasi

       $pdf->AddPage($orientation, [$size['width'], $size['height']]);
       $pdf->useTemplate($templateId);
   }

   // Simpan file PDF hasil penggabungan
   $outputPath = public_path('merged_1.pdf');
   $pdf->Output($outputPath, 'F');

        $oMerger = PDFMerger::init();
            // foreach($item_employee as $item_document){                
            //     $oMerger->addPDF('file/document/employee/'.$item_document, 'all');                
            // }
            // $oMerger->addPDF('file/document/employee/11113_file_kk.pdf', 'all');
            $oMerger->addPDF('file/document/employee/11113_ktp_file.pdf', 'all');
            // $oMerger->stream();
            $oMerger->merge();
            $oMerger->save($employee_uuid.'_all_4.pdf');
            // return ResponseFormatter::toJson($oMerger, 'aaa');
            // $oMerger->merge('file', $employee_uuid.'_all.pdf');
            return ResponseFormatter::toJson(env('APP_URL').'file/document/employee/2953711113_ktp_file.pdf', 'aaa');
            // $oMerger->save($employee_uuid.'_all.pdf');
```

> POST Template JQuery
```
                $.ajax({
                url: '/app/data/applicant',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),                       
                    employee_uuid: uuid
                },
                success: function(response) {
                    data = response.data
                    console.log(response);
                },
                error: function(response) {
                    console.log(response)
                }
            });
```

> choose month

```
INSERT INTO `departments` (`id`,`uuid`, `department`, `created_at`, `updated_at`) VALUES
(1,'uuid-production', 'PRODUCTION', '2022-07-14 19:57:07', '2022-07-14 19:57:07'),
(2,'uuid-hrga', 'HR & GA', '2022-07-14 19:57:07', '2022-07-14 19:57:07'),
(3,'uuid-engineering', 'ENGINEERING', '2022-07-14 19:57:15', '2022-07-14 19:57:15'),
(4,'uuid-plant', 'PLANT', '2022-07-15 19:58:54', '2022-07-15 19:58:54'),
(5,'uuid-infra', 'INFRA', '2022-07-15 19:59:44', '2022-07-15 19:59:44'),
(6,'uuid-hauling', 'HAULING', '2022-07-15 20:00:44', '2022-07-15 20:00:44'),
(7,'uuid-shipping', 'SHIPPING', '2022-07-15 20:00:44', '2022-07-15 20:00:44');

```

# Database

> Department

```
INSERT INTO `departments` (`id`,`uuid`, `department`, `created_at`, `updated_at`) VALUES
(1,'uuid-production', 'PRODUCTION', '2022-07-14 19:57:07', '2022-07-14 19:57:07'),
(2,'uuid-hrga', 'HR & GA', '2022-07-14 19:57:07', '2022-07-14 19:57:07'),
(3,'uuid-engineering', 'ENGINEERING', '2022-07-14 19:57:15', '2022-07-14 19:57:15'),
(4,'uuid-plant', 'PLANT', '2022-07-15 19:58:54', '2022-07-15 19:58:54'),
(5,'uuid-infra', 'INFRA', '2022-07-15 19:59:44', '2022-07-15 19:59:44'),
(6,'uuid-hauling', 'HAULING', '2022-07-15 20:00:44', '2022-07-15 20:00:44'),
(7,'uuid-shipping', 'SHIPPING', '2022-07-15 20:00:44', '2022-07-15 20:00:44');

```

> units

```
INSERT INTO `units` (`id`,`uuid`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'units-Bucket', 'Bucket', '2022-07-29 07:13:32', '2022-07-29 07:13:32'),
(2, 'units-Ton', 'Ton', '2022-07-30 07:41:27', '2022-07-30 07:41:27');

```

> units group

```
INSERT INTO `unit_groups` (`id`, `uuid`,`unit_uuid`, `unit_group`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'unit-group-Hino', 'units-Ton', 'Hino 900', 30, '2022-07-30 07:49:56', '2022-07-30 07:49:56'),
(2, 'unit-group-Sanny', 'units-Bucket', 'Sanny 500', 2.3, '2022-08-31 08:57:49', '2022-08-31 08:57:49');
```

> vehicle group

```
INSERT INTO `vehicle_groups` (`id`,`uuid`, `unit_group_uuid`, `vehicle_group`, `vehicle_code`, `created_at`, `updated_at`) VALUES
(1, 'vehicle-group-Drump', 'unit-group-Hino', 'Drump Truck', 'DT', '2022-07-31 09:57:23', '2022-07-31 09:57:23'),
(2, 'vehicle-group-Excavator', 'unit-group-Sanny', 'Excavator', 'LG', '2022-08-31 08:58:06', '2022-08-31 08:58:06');
```

> vehicle

```
INSERT INTO `vehicles` (`id`, `uuid`,`vehicle_group_uuid`, `number`, `created_at`, `updated_at`) VALUES
(1,'vehicle-1', 'vehicle-group-Drump', 1, '2022-07-31 21:11:01', '2022-07-31 21:11:01'),
(2,'vehicle-2', 'vehicle-group-Drump', 2, '2022-07-31 21:11:01', '2022-07-31 21:11:01'),
(3,'vehicle-3', 'vehicle-group-Drump', 3, '2022-07-31 21:11:01', '2022-07-31 21:11:01'),
(4,'vehicle-4', 'vehicle-group-Excavator', 1, '2022-08-31 08:58:17', '2022-08-31 08:58:17'),
(5,'vehicle-5', 'vehicle-group-Excavator', 2, '2022-08-31 08:58:22', '2022-08-31 08:58:22'),
(6,'vehicle-6', 'vehicle-group-Drump', 12, '2022-08-31 08:58:29', '2022-08-31 08:58:29'),
(7,'vehicle-7', 'vehicle-group-Drump', 33, '2022-08-31 08:58:36', '2022-08-31 08:58:36');
```

> pit

```
INSERT INTO `pits` (`id`,`uuid`, `employee_uuid`, `mine_uuid`, `pit_name`, `created_at`, `updated_at`) VALUES
(1,'mine-uuid-1','uuid11', 'mine-1', 'arwana', '2022-08-31 08:58:36', '2022-08-31 08:58:36');
```

> religion

```
INSERT INTO `religions` (`id`,`uuid`, `religion`, `created_at`, `updated_at`) VALUES
(1,'uuid-islam', 'Islam', '2022-08-02 19:14:36', '2022-08-02 19:14:36'),
(2,'uuid-kristen', 'Kristen', '2022-08-02 19:14:36', '2022-08-02 19:14:36'),
(3,'uuid-katolik', 'Katolik', '2022-08-02 19:14:36', '2022-08-02 19:14:36'),
(4,'uuid-hindu', 'Hindu', '2022-08-02 19:14:36', '2022-08-02 19:14:36'),
(5,'uuid-budha', 'Budha', '2022-08-02 19:14:36', '2022-08-02 19:14:36'),
(6,'uuid-konghucu', 'Konghucu', '2022-08-02 19:14:36', '2022-08-02 19:14:36');

```

> Positions

```

INSERT INTO `positions` (`id`,`uuid`, `position`, `created_at`, `updated_at`) VALUES
(1, 'position-1Bubut','Bubut Operator', NULL, NULL),
(2, 'position-2Bulldozer','Bulldozer Operator', NULL, NULL),
(3, 'position-3Checker','Checker Mining', NULL, NULL),
(4, 'position-4Checker','Checker Production', NULL, NULL),
(5, 'position-5Civil','Civil Bangunan', NULL, NULL),
(6, 'position-6Civil','Civil Maintenance', NULL, NULL),
(7, 'position-7Cooky','Cooky', NULL, NULL),
(8, 'position-8Crusher','Crusher Crew', NULL, NULL),
(9, 'position-9Driver','Driver Water Truck', NULL, NULL),
(10, 'position-10DT','DT Driver', NULL, NULL),
(11, 'position-11DT','DT Operator', NULL, NULL),
(12, 'position-12Dump','Dump Man Tambang', NULL, NULL),
(13, 'position-13Engineering','Engineering', NULL, NULL),
(14, 'position-14Entry','Entry Data Processing', NULL, NULL),
(15, 'position-15Excavator','Excavator Operator', NULL, NULL),
(16, 'position-16Excavator','Excavator Operator Production', NULL, NULL),
(17, 'position-17Foreman','Foreman Hauling', NULL, NULL),
(18, 'position-18Fuel','Fuel Foreman', NULL, NULL),
(19, 'position-19Fuel','Fuel Truck Driver (Renault)', NULL, NULL),
(20, 'position-20Fuelman','Fuelman', NULL, NULL),
(21, 'position-21General','General Worker', NULL, NULL),
(22, 'position-22General','General Worker (Jahe)', NULL, NULL),
(23, 'position-23General','General Worker Mining', NULL, NULL),
(24, 'position-24General','General Worker Production', NULL, NULL),
(25, 'position-25Genset','Genset Operator', NULL, NULL),
(26, 'position-26Grader','Grader Operator Production', NULL, NULL),
(27, 'position-27HD','HD Operator', NULL, NULL),
(28, 'position-28Helper','Helper Excavator Operator', NULL, NULL),
(29, 'position-29HELPER','HELPER MECHANIC', NULL, NULL),
(30, 'position-30HR','HR&GA Administration Clerk', NULL, NULL),
(31, 'position-31HRGA','HRGA Officer', NULL, NULL),
(32, 'position-32LV','LV Driver', NULL, NULL),
(33, 'position-33LV','LV Driver HRGA', NULL, NULL),
(34, 'position-34LV','LV Driver Production', NULL, NULL),
(35, 'position-35Master','Master Excavator Operator Production', NULL, NULL),
(36, 'position-36Mechanic','Mechanic', NULL, NULL),
(37, 'position-37Mechanic','Mechanic Deco', NULL, NULL),
(38, 'position-38Mechanic','Mechanic Helper', NULL, NULL),
(39, 'position-39Medic','Medic', NULL, NULL),
(40, 'position-40Monitoring','Monitoring Control', NULL, NULL),
(41, 'position-41Nursery','Nursery Crew', NULL, NULL),
(42, 'position-42Plant','Plant Foreman', NULL, NULL),
(43, 'position-43Production','Production Foreman', NULL, NULL),
(44, 'position-44Quality','Quality Control', NULL, NULL),
(45, 'position-45Safety','Safety Administration', NULL, NULL),
(46, 'position-46Safety','Safety Man', NULL, NULL),
(47, 'position-47Security','Security', NULL, NULL),
(48, 'position-48Service','Service Maintenance', NULL, NULL),
(49, 'position-49Sr','Sr. Welder', NULL, NULL),
(50, 'position-50Tyreman','Tyreman', NULL, NULL),
(51, 'position-51Unit','Unit Maintence & Washing Plant Adm Cleark', NULL, NULL),
(52, 'position-52Unit','Unit Maintence & Washing Plant Crew', NULL, NULL),
(53, 'position-53Ustadz','Ustadz', NULL, NULL),
(54, 'position-54Welder','Welder', NULL, NULL),
(55, 'position-55Whasing','Whasing Plant', NULL, NULL),
(56, 'position-56Supervisor','Supervisor Production', '2022-08-15 03:36:12', '2022-08-15 03:36:12');
```

```
INSERT INTO safety_employees (`uuid`, `employee_contract_uuid`) VALUES
('safety-employee-1', 'EmployeeContract-5e543ea4-7bfa-4c3f-af20-99a56b9087f3'),
('safety-employee-2', 'EmployeeContract-a5d23204-fd09-4d5a-affd-901ddc815121'),
('safety-employee-3', 'EmployeeContract-43063486-f8cf-49a4-8fe3-0efc47786628'),
('safety-employee-4', 'EmployeeContract-357773d5-e2e5-4eb0-b660-5c8de42a407e'),
('safety-employee-5', 'EmployeeContract-086a8568-b415-4e2a-a166-d4109968c978'),
('safety-employee-6', 'EmployeeContract-d175bcfd-1965-4010-8799-ba3635d352aa'),
('safety-employee-7', 'EmployeeContract-a9c07f48-3135-4b0f-82f9-769702665b1a'),
('safety-employee-8', 'EmployeeContract-9867603a-f063-4f7a-9718-08895a388fcc'),
('safety-employee-9', 'EmployeeContract-c22759b0-a69b-4e2d-9eb5-b0903e701e4f');
```

```
{
    'table-name' : {
        'code-data-n-on-this-table':{
            'field-n' : 'value_field',
            'field-n' : 'value_field',
        }
    },
    'table_activity_port' : {
        'code-data-n-on-this-table':{
            'field-n' : 'value_field',
            'field-n' : 'value_field',
        }
    }

}

```

"
    ="
        "
            OPLD/
        "
    "
"


"=""OPLD/""&"BG32"








