import 'package:flutter/material.dart';
import 'pages/login_pages.dart';
import 'pages/dashboard_pages.dart';
import 'pages/category_pages.dart';
import 'pages/peminjaman_pages.dart';
import 'pages/pengembalian_pages.dart';
import 'package:shared_preferences/shared_preferences.dart';
void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  final prefs = await SharedPreferences.getInstance();
  final token = prefs.getString('token');

  runApp(MyApp(isLoggedIn: token != null));
}

class MyApp extends StatelessWidget {
  final bool isLoggedIn;

  const MyApp({super.key, required this.isLoggedIn});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Sisfo Sarpras',
      theme: ThemeData(primarySwatch: Colors.blue),
      initialRoute: isLoggedIn ? '/dashboard' : '/login',
      routes: {
        '/login': (context) => const LoginPage(),
        '/dashboard': (context) => const DashboardPage(),
        '/kategori': (context) => const CategoryPage(),
        '/peminjaman': (context) => const PeminjamanPage(),
        '/pengembalian': (context) => const PengembalianPage(),
      },
    );
  }
}
