import 'package:flutter/material.dart';
import 'pages/login_pages.dart';
import 'pages/register_pages.dart';
import 'pages/dashboard_pages.dart';
import 'pages/category_pages.dart';
import 'pages/peminjaman_pages.dart';
import 'pages/pengembalian_pages.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Sisfo Sarpras',
      theme: ThemeData(primarySwatch: Colors.blue),
      initialRoute: '/login',
      routes: {
        '/login': (context) => const LoginPage(),
        '/register': (context) => const RegisterPage(),
        '/dashboard': (context) => const DashboardPage(),
        '/kategori': (context) => const CategoryPage(),
        '/peminjaman': (context) => const PeminjamanPage(),
        '/pengembalian': (context) => const PengembalianPage(),
      },
    );
  }
}
