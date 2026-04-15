<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF | BTL-CD1</title>

    <style type="text/css">
        /* Cấu hình font để hiển thị tiếng Việt chuẩn trong PDF */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.worker.min.js"); /* Chỉ mang tính minh họa đường dẫn */
        }
        
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif; /* Dùng font này để không lỗi tiếng Việt */
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            background: #fff;
        }

        .container {
            padding: 30px 40px;
        }

        /* Phần thông tin cá nhân dùng table để chia cột avatar và info */
        .personal-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .avatar-cell {
            width: 150px;
            vertical-align: top;
        }

        .avatar-cell img {
            width: 130px;
            border: 1px solid #ddd;
        }

        .info-cell {
            vertical-align: top;
            padding-left: 20px;
        }

        .name-title h2 {
            font-size: 24px;
            color: #479099;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .position-text {
            font-size: 16px;
            color: #555;
            font-style: italic;
            margin-bottom: 15px;
            display: block;
        }

        .detail-info-table {
            width: 100%;
            font-size: 13px;
        }

        .detail-info-table td {
            padding: 3px 0;
        }

        /* Tiêu đề các mục */
        .title-section {
            border-bottom: 2px solid #479099;
            margin: 25px 0 15px 0;
            clear: both;
        }

        .title-section h4 {
            background: #479099;
            color: #fff;
            display: inline-block;
            padding: 5px 15px;
            font-size: 16px;
            text-transform: uppercase;
        }

        /* Cấu trúc chung cho Exp, Edu, Project */
        .item-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .left-col {
            width: 180px;
            vertical-align: top;
            font-weight: bold;
            color: #444;
            padding-right: 15px;
        }

        .right-col {
            vertical-align: top;
            padding-left: 15px;
            border-left: 1px solid #eee;
        }

        .company-name, .school-name, .project-name {
            font-size: 15px;
            font-weight: bold;
            color: #000;
            display: block;
        }

        .sub-text {
            font-style: italic;
            color: #666;
            margin: 3px 0;
            display: block;
        }

        /* Fix lỗi dính chữ cho phần Dự án */
        .projects-box {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .project-label {
            font-weight: bold;
            color: #479099;
            margin-bottom: 8px;
            display: block;
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <table class="personal-table">
        <tr>
            <td class="avatar-cell">
                <img src="{{$pic}}" alt="avatar">
            </td>
            <td class="info-cell">
                <div class="name-title">
                    <h2>{{$profile->name}}</h2>
                    <span class="position-text">{{$profile->position}}</span>
                </div>
                <table class="detail-info-table">
                    <tr>
                        <td width="50%"><strong>Ngày sinh:</strong> {{$profile->dateOfBirth ? \Carbon\Carbon::parse($profile->dateOfBirth)->isoFormat('D/MM/YYYY') : ''}}</td>
                        <td><strong>Điện thoại:</strong> {{$profile->phone_number}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong> {{$profile->email}}</td>
                        <td><strong>Địa chỉ:</strong> {{$profile->address}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="title-section">
        <h4>Giới thiệu bản thân</h4>
    </div>
    <div style="text-align: justify;">
        {!! html_entity_decode($profile->introduce) !!}
    </div>

    @if(count($exp) > 0)
        <div class="title-section">
            <h4>Kinh nghiệm việc làm</h4>
        </div>
        @foreach($exp as $item)
            <table class="item-table">
                <tr>
                    <td class="left-col">
                        {{\ ($item->start_time ? \Carbon\Carbon::parse($item->start_time)->isoFormat('MM/YYYY') : '') }} - {{ ($item->end_time ? \Carbon\Carbon::parse($item->end_time)->isoFormat('MM/YYYY') : '') }}
                    </td>
                    <td class="right-col">
                        <span class="company-name">{{$item->name_company}}</span>
                        <span class="sub-text">{{$item->job_position}}</span>
                        <div style="margin-top: 5px;">
                            {!! html_entity_decode($item->job_details) !!}
                        </div>
                    </td>
                </tr>
            </table>
        @endforeach
    @endif

    @if(count($edu) > 0)
        <div class="title-section">
            <h4>Học vấn</h4>
        </div>
        @foreach($edu as $item)
            <table class="item-table">
                <tr>
                    <td class="left-col">
                        {{\ ($item->start_year ? \Carbon\Carbon::parse($item->start_year)->isoFormat('MM/YYYY') : '') }} - {{ ($item->end_year ? \Carbon\Carbon::parse($item->end_year)->isoFormat('MM/YYYY') : '') }}
                    </td>
                    <td class="right-col">
                        <span class="school-name">{{$item->name_school}}</span>
                        <span class="sub-text">{{$item->degree}}</span>
                    </td>
                </tr>
            </table>
        @endforeach
    @endif

    @if(count($pro) > 0)
        <div class="title-section">
            <h4>Dự án thực hiện</h4>
        </div>
        @foreach($pro as $item)
            <table class="item-table" style="margin-bottom: 25px;">
                <tr>
                    {{-- Cột bên trái: Giữ trống hoặc để icon cho đồng bộ với các mục trên --}}
                    <td class="left-col" style="font-size: 12px; color: #666;">
                        DỰ ÁN
                    </td>
                    
                    {{-- Cột bên phải: Chứa toàn bộ nội dung --}}
                    <td class="right-col">
                        <span class="project-name" style="font-size: 16px; color: #000; font-weight: bold;">
                            {{ $item->name_project }}
                        </span>
                        
                        {{-- Hiển thị thời gian ngay dưới tên dự án --}}
                        <div style="margin: 5px 0;">
                            <span style="background: #e8f4f5; padding: 2px 8px; border-radius: 3px; font-size: 12px; color: #479099; font-weight: bold;">
                                Thời gian: {{ $item->time_project }}
                            </span>
                        </div>

                        <div class="projects-box" style="background-color: #f9f9f9; padding: 10px; margin-top: 10px; border-left: 3px solid #479099;">
                            <strong style="font-size: 13px; color: #444; display: block; margin-bottom: 5px;">Thông tin dự án:</strong>
                            <div style="text-align: justify; font-size: 13px;">
                                {!! html_entity_decode($item->introduce_pro) !!}
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        @endforeach
    @endif