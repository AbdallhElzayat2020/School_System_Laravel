Tables
{
 المرحلة تحتوي علي الصفوف (المرحلة تحتوي علي اكتر من صف)
    grades  المراحل الدراسية
        [
            id
            name
            notes
            created_at
            updated_at
        ]

        الصفوف الدراسية classrooms
        [
            id
            forginId -> grade_id  علاقة بين جدول المراحل الدراسية   والصف الدراسي     مثال الصف الاول تبع المرحلة الابتدائية 
            description
            name
            created_at
            updated_at
        ]

        sections table [ 
            id
            section_name
            status
            grade_id    $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
            class_id    $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete()->cascadeOnUpdate();
            created_at
            updated_at
        ]


}
